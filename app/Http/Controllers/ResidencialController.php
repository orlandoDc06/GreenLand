<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residencial;

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
    
    public function edit()
    {
        $residenciales = Residencial::all();
        dd($residenciales);
        return view('editMap', compact('residenciales'));
    }
}