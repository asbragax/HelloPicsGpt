<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::query()->delete();

        Produto::create([
            'name' => 'Pack Clássico',
            'size' => '5x7',
            'photo_limit' => 10,
            'price' => 39.90,
            'includes_caption' => true,
            'includes_mold' => true,
            'status' => true,
        ]);

        Produto::create([
            'name' => 'Pack Mini',
            'size' => '5x5',
            'photo_limit' => 6,
            'price' => 24.90,
            'includes_caption' => false,
            'includes_mold' => true,
            'status' => true,
        ]);

        Produto::create([
            'name' => 'Pack Grande',
            'size' => '7x10',
            'photo_limit' => 12,
            'price' => 49.90,
            'includes_caption' => true,
            'includes_mold' => false,
            'status' => true,
        ]);
    }
}
