<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'produto_id',
        'status',
        'photo_delivery_type',
        'photo_link',
        'caption_enabled',
        'total_price',
        'shipping_address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto')
            ->withPivot('quantidade', 'preco_unitario')
            ->withTimestamps();
    }


    // Em Pedido.php
    public function fotos()
    {
        return $this->hasManyThrough(
            \App\Models\Photo::class,
            \App\Models\PedidoProduto::class,
            'pedido_id',           // foreign key on pedido_produto
            'pedido_produto_id',   // foreign key on photos
            'id',                  // local key on pedidos
            'id'                   // local key on pedido_produto
        );
    }

    public function statusLogs()
    {
        return $this->hasMany(StatusLog::class);
    }

    public function atualizarStatus($novoStatus)
    {
        if ($this->status !== $novoStatus) {
            $this->status = $novoStatus;
            $this->save();

            $this->statusLogs()->create([
                'status' => $novoStatus,
                'changed_at' => now()
            ]);
        }
    }
}
