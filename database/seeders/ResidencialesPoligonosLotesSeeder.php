<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResidencialesPoligonosLotesSeeder extends Seeder
{
    /**
     * Ejecutar las semillas de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Crear una Residencial
        $residencial = DB::table('residenciales')->insertGetId([
            'nombre_residencial' => 'Greenland',
            'ubicacion' => 'San Miguel',
            'total_poligonos' => 35,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // // Crear Polígonos para esa Residencial
        // for ($i = 1; $i <= 35; $i++) {
        //     $poligono = DB::table('poligonos')->insertGetId([
        //         'residencial_id' => $residencial,
        //         'nombre_poligono' => 'Pol ' . $i,
        //         'total_lotes' => 20,
        //         'lotes_disponibles' => 20,  // Todos los lotes están disponibles al principio
        //         'coordenada_x' => 0,
        //         'coordenada_y' => 0,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);

        //     // Crear Lotes para ese Polígono
        //     for ($j = 1; $j <= 20; $j++) {
        //         DB::table('lotes')->insert([
        //             'poligono_id' => $poligono,
        //             'precio' => 25000,
        //             'estado' => 'Disponible',  // Puedes cambiar el estado si lo deseas
        //             'descuento' => null,  // No hay descuento por el momento
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ]);
        //     }
        // }
    }
}
