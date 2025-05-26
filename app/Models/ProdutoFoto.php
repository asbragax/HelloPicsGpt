<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'caminho',
        'principal',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
