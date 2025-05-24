<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['pedido_id', 'filename', 'caption', 'position'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function pedidoProduto()
    {
        return $this->belongsTo(PedidoProduto::class);
    }

}
