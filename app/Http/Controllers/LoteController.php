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
            ->select(
                'id',
                'poligono_id',
                'codigo_lote',
                'precio_lote',
                'estado',
                'coordenada_x',
                'coordenada_y',
                'superficie_m',
                'superficie_v',
                'direccion',           // Campo agregado
                'pcontado_porcent',    // Campo agregado
                'vprima_porcent',      // Campo agregado
                'descuento'            // Campo agregado
            );

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
            ->select(
                'id',
                'codigo_lote',
                'precio_lote',
                'estado',
                'coordenada_x',
                'coordenada_y',
                'superficie_m',
                'superficie_v',
                'direccion',           // Campo agregado
                'pcontado_porcent',    // Campo agregado
                'vprima_porcent',      // Campo agregado
                'descuento'            // Campo agregado
            )
            ->get();

        if ($lotes->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No hay lotes para este polígono']);
        }

        return response()->json(['success' => true, 'lotes' => $lotes]);
    }
    public function update(Request $request, $id)
    {
        $lote = Lote::findOrFail($id);

        $data = $request->only([
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
        ]);

        // Validar que la superficie en varas sea mayor a 0 para los cálculos
        $superficie_v = floatval($data['superficie_v'] ?? 0);
        if ($superficie_v <= 0) {
            return redirect()->back()->with('error', 'La superficie en varas cuadradas debe ser mayor a 0.');
        }

        // Obtener valores actuales del lote para comparación
        $precio_lote_actual = floatval($lote->precio_lote);
        $precio_s_v_actual = floatval($lote->precio_s_v);

        // Valores enviados desde el formulario
        $precio_lote_nuevo = floatval($data['precio_lote'] ?? 0);
        $precio_s_v_nuevo = floatval($data['precio_s_v'] ?? 0);

        // Determinar qué campo fue modificado y recalcular el otro
        $precio_lote_modificado = abs($precio_lote_nuevo - $precio_lote_actual) > 0.01;
        $precio_s_v_modificado = abs($precio_s_v_nuevo - $precio_s_v_actual) > 0.01;

        if ($precio_lote_modificado && !$precio_s_v_modificado) {
            // El precio del lote fue editado, recalcular precio por vara
            $data['precio_s_v'] = $precio_lote_nuevo / $superficie_v;
            $precio_final = $precio_lote_nuevo;
        } elseif ($precio_s_v_modificado && !$precio_lote_modificado) {
            // El precio por vara fue editado, recalcular precio del lote
            $data['precio_lote'] = $precio_s_v_nuevo * $superficie_v;
            $precio_final = $data['precio_lote'];
        } elseif ($precio_lote_modificado && $precio_s_v_modificado) {
            // Ambos fueron modificados, dar prioridad al precio del lote
            $data['precio_s_v'] = $precio_lote_nuevo / $superficie_v;
            $precio_final = $precio_lote_nuevo;
        } else {
            // Ninguno fue modificado significativamente, mantener valores actuales
            $precio_final = $precio_lote_actual;
        }

        // Calcular campos derivados
        $pcontado_porcent = floatval($data['pcontado_porcent'] ?? 0);
        $vprima_porcent = floatval($data['vprima_porcent'] ?? 0);

        // Calcular precio contado
        $data['precio_contado'] = $precio_final * (1 - $pcontado_porcent / 100);

        // Calcular valor de la prima
        $data['valor_prima'] = $precio_final * $vprima_porcent / 100;

        // Actualizar el lote con todos los datos calculados
        $lote->update($data);

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
