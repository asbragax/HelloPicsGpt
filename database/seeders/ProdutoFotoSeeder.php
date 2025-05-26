<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\ProdutoFoto;

class ProdutoFotoSeeder extends Seeder
{
    public function run()
    {
        // Para cada produto existente
        Produto::all()->each(function ($produto) {
            // Adiciona 3 fotos por produto
            for ($i = 1; $i <= 3; $i++) {
                ProdutoFoto::create([
                    'produto_id' => $produto->id,
                    'caminho' => "produtos/fake{$i}.jpg",
                    'principal' => $i === 1, // primeira é principal
                ]);
            }
        });
    }
}
