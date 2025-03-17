<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'precio',
        'stock',
        'nota',
        'idcategoria',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }
    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'idproducto');
    }
}
