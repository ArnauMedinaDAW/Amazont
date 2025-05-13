<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

<<<<<<< Updated upstream
<<<<<<< Updated upstream
    protected $table = 'opiniones';

=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    protected $fillable = ['producto_id', 'comentario'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
