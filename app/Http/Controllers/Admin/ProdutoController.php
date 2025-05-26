<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    public function store(Request $request)
    {
        $produto = Produto::create($request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'photo_limit' => 'required|integer',
            'includes_mold' => 'required|boolean',
        ]));
        return redirect()->route('admin.produtos.show', $produto->id)->with('success', 'Produto criado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        return view('admin.produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('admin.produtos.show', $produto->id)->with('success', 'Produto criado com sucesso.');
    }

    public function show($id)
    {
        $produto = Produto::with(['fotos', 'fotoPrincipal'])->findOrFail($id);
        return view('admin.produtos.show', compact('produto'));
    }


    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('admin.produtos.index')->with('success', 'Produto removido.');
    }
}
