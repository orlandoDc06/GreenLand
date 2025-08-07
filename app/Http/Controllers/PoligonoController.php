<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Poligono;
use App\Models\Lote;
use Illuminate\Support\Str;
use App\Models\Residencial;

class PoligonoController extends Controller
{
    public function getPoligonos()
    {
        $poligonos = DB::table('poligonos')
            ->select('id', 'nombre_poligono', 'total_lotes', 'lotes_disponibles', 'disponibilidad', 'coordenada_x', 'coordenada_y')
            ->get();

        return response()->json(['success' => true, 'poligonos' => $poligonos]);
    }

    public function edit()
    {
        $poligonos = Poligono::all();

        return view('edit', compact('poligonos'));
    }

    public function editMap()
    {
        $residenciales = Residencial::all();
        $poligonos = Poligono::all();

        return view('editMap', compact('poligonos', 'residenciales'));
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

    public function updateMap(Request $request)
    {
        $request->validate([
            'nombre_poligono' => 'required|string|max:55',
            'total_lotes' => 'required|integer|min:0',
            'lotes_disponibles' => 'required|integer|min:0|max:' . $request->total_lotes,
            'coordenada_x' => 'required|integer',
            'coordenada_y' => 'required|integer',
            'residencial_id' => 'required|exists:residenciales,id',
        ]);

        try {
            $poligono = Poligono::create([
                'nombre_poligono' => $request->nombre_poligono,
                'total_lotes' => $request->total_lotes,
                'lotes_disponibles' => $request->lotes_disponibles,
                'disponibilidad' => $request->lotes_disponibles,
                'coordenada_x' => $request->coordenada_x,
                'coordenada_y' => $request->coordenada_y,
                'residencial_id' => $request->residencial_id,
            ]);

            for ($i = 1; $i <= $request->total_lotes; $i++) {
                try {
                    Lote::create([
                        'poligono_id' => $poligono->id,
                        'codigo_lote' => "Lote $i",
                        'precio_lote' => 0.00,
                        'estado' => 'Disponible',
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Error al crear lote: ' . $e->getMessage());

                }
            }

            return redirect()->route('edit.map')->with('success', 'Polígono creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('edit.map')->with('error', 'Error al crear el polígono: ' . $e->getMessage());
        }
    }



    public function show($poligonoId)
    {
        $poligono = Poligono::findOrFail($poligonoId);
        $lotes = Lote::where('poligono_id', $poligonoId)->get();

        return view('poligono', compact('poligono', 'lotes'));
    }
    public function mostrar($poligonoId)
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre_poligono' => 'required|string|max:55',
            'total_lotes' => 'required|integer|min:1',
            'lotes_disponibles' => 'required|integer|min:0|max:' . $request->total_lotes,
            'coordenada_x' => 'required|integer',
            'coordenada_y' => 'required|integer',
            'residencial_id' => 'required|exists:residenciales,id',
        ]);

        $slug = Str::slug($request->nombre_poligono);

        $poligono = Poligono::create([
            'residencial_id' => $request->residencial_id,
            'nombre_poligono' => $request->nombre_poligono,
            'total_lotes' => $request->total_lotes,
            'lotes_disponibles' => $request->lotes_disponibles,
            'coordenada_x' => $request->coordenada_x,
            'coordenada_y' => $request->coordenada_y,
            'slug' => $slug,
        ]);

        for ($i = 1; $i <= $request->total_lotes; $i++) {
            try {
                Lote::create([
                    'poligono_id' => $poligono->id,
                    'codigo_lote' => "Lote $i",
                    'precio_lote' => 0.00,
                    'estado' => 'Disponible',
                ]);
            } catch (\Exception $e) {
                \Log::error('Error al crear lote: ' . $e->getMessage());
                // Puedes decidir si continuar o detener el proceso
            }
        }

        return redirect()->route('mapa.edit')->with('success', 'Polígono y lotes agregados exitosamente.');
    }

}
