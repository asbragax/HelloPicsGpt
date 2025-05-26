<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ProdutoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoFotoController extends Controller
{
    public function store(Request $request, $produtoId)
    {
        $request->validate([
            'fotos.*' => 'required|image|max:2048'
        ]);

        foreach ($request->file('fotos') as $foto) {
            $path = $foto->store("produtos/fotos", 'public');

            ProdutoFoto::create([
                'produto_id' => $produtoId,
                'caminho' => $path,
                'principal' => false
            ]);
        }

        return back()->with('success', 'Fotos enviadas com sucesso.');
    }

    public function destroy($id)
    {
        $foto = ProdutoFoto::findOrFail($id);

        if ($foto->caminho && Storage::disk('public')->exists($foto->caminho)) {
            Storage::disk('public')->delete($foto->caminho);
        }

        $foto->delete();

        return back()->with('success', 'Foto excluída com sucesso.');
    }

    public function marcarPrincipal($id)
    {
        $foto = ProdutoFoto::findOrFail($id);

        ProdutoFoto::where('produto_id', $foto->produto_id)->update(['principal' => false]);

        $foto->principal = true;
        $foto->save();

        return back()->with('success', 'Foto marcada como principal.');
    }
}
