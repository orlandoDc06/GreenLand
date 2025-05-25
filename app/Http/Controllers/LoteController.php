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
            ->select('id', 'poligono_id', 'codigo_lote', 'precio_lote', 'estado', 'coordenada_x', 'coordenada_y', 'superficie_m', 'superficie_v');

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
            ->select('id', 'codigo_lote', 'precio_lote', 'estado', 'coordenada_x', 'coordenada_y', 'superficie_m', 'superficie_v')
            ->get();

        if ($lotes->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No hay lotes para este polígono']);
        }

        return response()->json(['success' => true, 'lotes' => $lotes]);
    }

    public function update(Request $request, $id)
    {
        $lote = Lote::findOrFail($id);
        $lote->update($request->only([
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
        ]));

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
                'codigo_lote' => $lote->codigo_lote,
                'superficie_m' => $lote->superficie_m,
                'superficie_v' => $lote->superficie_v,
                'precio_s_v' => $lote->precio_s_v,
                'precio_lote' => $lote->precio_lote,
                'pcontado_porcent' => $lote->pcontado_porcent,
                'vprima_porcent' => $lote->vprima_porcent,
                'direccion' => $lote->direccion,
                'estado' => $lote->estado,
                'coordenada_x' => $lote->coordenada_x,
                'coordenada_y' => $lote->coordenada_y,
                'descuento' => $lote->descuento,
                'poligono_id' => $lote->poligono_id
            ]
        ]);
    }
}
