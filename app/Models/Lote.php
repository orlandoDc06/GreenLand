<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $fillable = ['precio', 'estado', 'descuento', 'poligono_id'];

    public function poligono()
    {
        return $this->belongsTo(Poligono::class);
    }
}
