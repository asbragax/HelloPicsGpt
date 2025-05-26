<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moldura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MolduraController extends Controller
{
    public function index()
    {
        $molduras = Moldura::all();
        return view('admin.molduras.index', compact('molduras'));
    }

    public function create()
    {
        return view('admin.molduras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image'
        ]);

        $data = $request->only(['nome', 'descricao']);

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('molduras', 'public');
            $data['imagem'] = $path;
        }

        Moldura::create($data);

        return redirect()->route('admin.molduras.index')->with('success', 'Moldura criada com sucesso.');
    }

    public function edit(Moldura $moldura)
    {
        return view('admin.molduras.edit', compact('moldura'));
    }

    public function update(Request $request, Moldura $moldura)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image'
        ]);

        $data = $request->only(['nome', 'descricao']);

        if ($request->hasFile('imagem')) {
            if ($moldura->imagem && Storage::disk('public')->exists($moldura->imagem)) {
                Storage::disk('public')->delete($moldura->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('molduras', 'public');
        }

        $moldura->update($data);

        return redirect()->route('admin.molduras.index')->with('success', 'Moldura atualizada.');
    }

    public function destroy(Moldura $moldura)
    {
        if ($moldura->imagem && Storage::disk('public')->exists($moldura->imagem)) {
            Storage::disk('public')->delete($moldura->imagem);
        }

        $moldura->delete();

        return redirect()->route('admin.molduras.index')->with('success', 'Moldura removida.');
    }
}
