<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'puntuacion'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
