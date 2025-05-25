<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    //protected $table = 'lotes';

    protected $fillable = [
        'poligono_id',
        'codigo_lote',
        'superficie_m',
        'superficie_v',
        'precio_s_v',
        'precio_lote',
        'pcontado_porcent',
        'vprima_porcent',
        'direccion',
        'estado',
        'coordenada_x',
        'coordenada_y',
        'descuento'
    ];

    public function poligono()
    {
        return $this->belongsTo(Poligono::class);
    }
}
