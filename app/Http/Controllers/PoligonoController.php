<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoligonoController extends Controller
{
    public function getPoligonos()
    {
        // Devuelve los datos de todos los polígonos
        $poligonos = DB::table('poligonos')
            ->select('id', 'nombre_poligono', 'total_lotes', 'lotes_disponibles', 'disponibilidad', 'coordenada_x', 'coordenada_y') 
            ->get();

        return response()->json(['success' => true, 'poligonos' => $poligonos]);
    }
}
