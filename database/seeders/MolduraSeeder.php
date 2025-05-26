<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moldura;

class MolduraSeeder extends Seeder
{
    public function run()
    {
        Moldura::insert([
            [
                'nome' => 'Clássica Branca',
                'descricao' => 'Moldura minimalista branca',
                'imagem' => 'molduras/classica-branca.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Vintage Preta',
                'descricao' => 'Estilo retrô preto com borda grossa',
                'imagem' => 'molduras/vintage-preta.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
