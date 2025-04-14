<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'idproducto', 'cantidad', 'preciototal', 'iduser', 'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }
}
