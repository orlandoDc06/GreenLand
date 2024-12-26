<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use Illuminate\Support\Facades\DB;
use App\Models\Poligono;


class LoteController extends Controller
{

    public function getLotes($poligonoId = null)
    {
        $query = DB::table('lotes')
            ->select('id', 'poligono_id', 'name', 'precio', 'estado', 'coordenada_x', 'coordenada_y', 'superficie');

        if ($poligonoId) {
            $query->where('poligono_id', $poligonoId);
        }

        $lotes = $query->get();

        return response()->json(['success' => true, 'lotes' => $lotes]);
    }

  
    public function getLotesByPoligono($poligono_id)
    {
        $lotes = DB::table('lotes')
            ->where('poligono_id', $poligono_id) 
            ->select('id', 'name', 'precio','estado', 'coordenada_x', 'coordenada_y', 'superficie')
            ->get();
    
        if ($lotes->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No hay lotes para este polígono']);
        }
    
        return response()->json(['success' => true, 'lotes' => $lotes]);
    }

    public function update(Request $request, $id)
    {
        $lote = Lote::findOrFail($id);
        $lote->update($request->only(['name', 'precio', 'estado', 'superficie']));
        return redirect()->back()->with('success', 'Lote actualizado correctamente.');
    }
    
    public function getLoteById($id)
    {
        $lote = Lote::find($id);

        if (!$lote) {
            return response()->json(['success' => false, 'message' => 'Lote no encontrado.']);
        }

        return response()->json([
            'success' => true,
            'lote' => [
                'id' => $lote->id,
                'name' => $lote->name,
                'precio' => $lote->precio,
                'estado' => $lote->estado,
                'superficie' => $lote->superficie,
            ]
        ]);
    }

     

}
