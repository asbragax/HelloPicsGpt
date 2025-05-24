<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $produto = Produto::inRandomOrder()->first();

        // Cria 5 usuários clientes fictícios
        User::factory()->count(5)->create(['role' => 'user'])->each(function ($user) {
            $pedido = Pedido::create([
                'user_id' => $user->id,
                'status' => 'pago',
                'photo_delivery_type' => 'link',
                'photo_link' => 'https://drive.google.com/fotos123',
                'caption_enabled' => true,
                'total_price' => 0,
                'shipping_address' => 'Rua Exemplo, 123 - Cidade Fictícia',
            ]);

            $produtos = Produto::inRandomOrder()->limit(2)->get();

            $total = 0;
            foreach ($produtos as $produto) {
                $pedido->produtos()->attach($produto->id, [
                    'quantidade' => 1,
                    'preco_unitario' => $produto->price
                ]);
                $total += $produto->price;
            }

            $pedido->update(['total_price' => $total]);
        });
    }
}
