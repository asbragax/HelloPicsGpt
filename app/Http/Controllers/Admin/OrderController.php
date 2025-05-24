<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoProduto;

class OrderController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['user', 'produtos'])->orderBy('created_at', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::with(['user', 'produtos', 'fotos'])->findOrFail($id);
        $pedidoProdutos = PedidoProduto::with('produto', 'fotos')
            ->where('pedido_id', $pedido->id)
            ->get();

        return view('admin.pedidos.show', compact('pedido', 'pedidoProdutos'));

    }


    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => $request->status]);

        return redirect()->route('admin.pedidos.show', $pedido->id)->with('success', 'Status atualizado.');
    }
}
