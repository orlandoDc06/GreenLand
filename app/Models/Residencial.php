<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residencial extends Model
{
    protected $fillable = ['nombre_residencial', 'ubicacion', 'total_poligonos'];

    public function poligonos()
    {
        return $this->hasMany(Poligono::class);
    }
}
