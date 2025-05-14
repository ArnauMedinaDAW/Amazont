<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';
    protected $primaryKey = 'id_metodo';

    protected $fillable = [
        'tipo', 'nombre', 'num_tarjeta', 'fecha_caducidad', 'codigo_validacion', 'user_id'
    ];

    public function setNumTarjetaAttribute($value)
    {
        $this->attributes['num_tarjeta'] = Crypt::encryptString($value);
    }

    public function getNumTarjetaAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setCodigoValidacionAttribute($value)
    {
        $this->attributes['codigo_validacion'] = Crypt::encryptString($value);
    }

    public function getCodigoValidacionAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
