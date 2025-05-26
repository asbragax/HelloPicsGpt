<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moldura;

class MolduraController extends Controller
{
    public function index()
    {
        return response()->json(
            Moldura::all()->map(function ($moldura) {
                return [
                    'id' => $moldura->id,
                    'nome' => $moldura->nome,
                    'descricao' => $moldura->descricao,
                    'imagem' => $moldura->imagem ? asset('storage/' . $moldura->imagem) : null,
                ];
            })
        );
    }
}
