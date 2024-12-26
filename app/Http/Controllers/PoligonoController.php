<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Poligono;
use App\Models\Lote;

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

    public function edit()
    {
        // Obtener todos los polígonos
        $poligonos = Poligono::all();

        // Retornar vista con los polígonos
        return view('edit', compact('poligonos'));
    }

    public function getPoligonoById($id)
    {
        $poligono = Poligono::find($id);
    
        if (!$poligono) {
            return response()->json(['success' => false, 'message' => 'Polígono no encontrado'], 404);
        }
    
        return response()->json(['success' => true, 'poligono' => $poligono]);
    }    

    public function update(Request $request)
    {
        $request->validate([
            'poligono_id' => 'required|exists:poligonos,id',
            'lotes_disponibles' => 'required|integer|min:0',
        ]);

        // Buscar y actualizar el polígono
        $poligono = Poligono::findOrFail($request->poligono_id);
        $poligono->lotes_disponibles = $request->lotes_disponibles;
        $poligono->save();

        return redirect()->route('edit')->with('success', 'Lotes disponibles actualizados correctamente.');
    }

    public function show($poligonoId)
    {
        $poligono = Poligono::findOrFail($poligonoId);
        $lotes = Lote::where('poligono_id', $poligonoId)->get();
    
        return view('poligono', compact('poligono', 'lotes'));
    }
    
    public function getLotesByPoligono($id)
    {
        $lotes = Lote::where('poligono_id', $id)->get();
    
        if ($lotes->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No hay lotes para este polígono']);
        }
    
        return response()->json(['success' => true, 'lotes' => $lotes]);
    }
    
}
