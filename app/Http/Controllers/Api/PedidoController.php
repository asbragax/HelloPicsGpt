<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\PedidoProduto;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $pedidos = Pedido::with('produtos')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($pedidos);
    }

    public function show(Request $request, $id)
    {
        $pedido = Pedido::with(['produtos', 'produtos.pivot', 'fotos'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $pedidoProdutos = PedidoProduto::with('produto', 'fotos')
            ->where('pedido_id', $pedido->id)
            ->get();

        return response()->json([
            'pedido' => $pedido,
            'produtos' => $pedidoProdutos
        ]);
    }

    public function uploadFotos(Request $request, $id)
    {
        $pedidoProduto = PedidoProduto::findOrFail($id);

        // Verifica se o pedido pertence ao usuário autenticado
        if ($pedidoProduto->pedido->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Acesso não autorizado.'], 403);
        }

        $request->validate([
            'fotos' => 'required|array|min:1',
            'fotos.*' => 'image|max:5120', // 5MB por imagem
            'caption' => 'array',
        ]);

        $fotos = $request->file('fotos');
        $captions = $request->input('caption', []);

        foreach ($fotos as $index => $foto) {
            $filename = $foto->store('uploads', 'public');

            Photo::create([
                'pedido_produto_id' => $pedidoProduto->id,
                'filename' => $filename,
                'caption' => $captions[$index] ?? null,
                'position' => $index
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'produtos' => 'required|array|min:1',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'photo_delivery_type' => 'required|in:upload,link',
            'photo_link' => 'nullable|string',
            'caption_enabled' => 'boolean',
            'shipping_address' => 'nullable|string'
        ]);

        $user = $request->user();

        // Cria pedido base
        $pedido = Pedido::create([
            'user_id' => $user->id,
            'status' => 'aguardando_pagamento',
            'photo_delivery_type' => $request->photo_delivery_type,
            'photo_link' => $request->photo_link,
            'caption_enabled' => $request->caption_enabled ?? false,
            'total_price' => 0,
            'shipping_address' => $request->shipping_address,
        ]);

        $total = 0;

        // Associar produtos
        foreach ($request->produtos as $item) {
            $produto = Produto::find($item['id']);
            $pedido->produtos()->attach($produto->id, [
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $produto->price
            ]);
            $total += $produto->price * $item['quantidade'];
        }

        // Atualizar preço total
        $pedido->update(['total_price' => $total]);

        return response()->json([
            'success' => true,
            'pedido_id' => $pedido->id
        ], 201);
    }

    public function statusLog(Request $request, $id)
    {
        $pedido = Pedido::where('user_id', $request->user()->id)->findOrFail($id);

        $logs = $pedido->statusLogs()->orderBy('changed_at')->get();

        return response()->json($logs);
    }

    public function cancelar(Request $request, $id)
    {
        $pedido = Pedido::where('user_id', $request->user()->id)->findOrFail($id);

        if (!in_array($pedido->status, ['aguardando_pagamento', 'pago'])) {
            return response()->json(['error' => 'Este pedido não pode mais ser cancelado.'], 403);
        }

        $pedido->atualizarStatus('cancelado');

        return response()->json(['success' => true, 'message' => 'Pedido cancelado com sucesso.']);
    }
}
