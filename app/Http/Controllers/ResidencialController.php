<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidencialController extends Controller
{
    public function index()
    {
        $residenciales = Residencial::with('poligonos')->get();
        return view('residenciales.index', compact('residenciales'));
    }

    public function show($id)
    {
        $residencial = Residencial::with('poligonos.lotes')->findOrFail($id);
        return view('residenciales.show', compact('residencial'));
    }
}
