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
        'name',
        'precio',
        'estado',
    ];
    
    public function poligono()
    {
        return $this->belongsTo(Poligono::class);
    }
}
