<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poligono extends Model
{
    protected $fillable = ['nombre_poligono', 'total_lotes', 'lotes_disponibles', 'residencial_id'];

    public function residencial()
    {
        return $this->belongsTo(Residencial::class);
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }
}
