<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoligonoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/mapa', function () {
    return view('maps');
})->name('mapa');

Route::get('/api/poligonos', [PoligonoController::class, 'getPoligonos']);