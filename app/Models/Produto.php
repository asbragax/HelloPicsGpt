<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'photo_limit',
        'price',
        'includes_caption',
        'includes_mold',
        'status',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_produto')
            ->withPivot('quantidade', 'preco_unitario')
            ->withTimestamps();
    }

    // Produto.php
    public function fotos()
    {
        return $this->hasMany(ProdutoFoto::class);
    }

    // Produto.php
    public function fotoPrincipal()
    {
        return $this->hasOne(ProdutoFoto::class)->where('principal', true);
    }
}
