<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::where('status', true)->get();

        return response()->json($produtos);
    }

    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return response()->json([
            'id' => $produto->id,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'preco' => $produto->preco,
            'photo_limit' => $produto->photo_limit,
            'includes_mold' => $produto->includes_mold,
            'fotos' => $produto->fotos->map(function ($foto) {
                return [
                    'url' => asset('storage/' . $foto->caminho),
                    'principal' => $foto->principal
                ];
            }),
            'created_at' => $produto->created_at,
            'updated_at' => $produto->updated_at,
        ]);
    }
}
