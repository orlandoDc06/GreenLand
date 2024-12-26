<?php
use App\Models\Lote;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoligonoController;
use App\Http\Controllers\AuthController;    
use App\Http\Controllers\LoteController;


Route::get('/', function () {
    return view('home');
});

Route::get('/mapa', function () {
    return view('maps');
})->name('mapa');

Route::get('/prueba', function () {
    return view('prueba');
});

//LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//LOGOUT
Route::post('/logout', [AuthController::class, 'destroy'])
    ->name('logout');

//API POLIGONOS
Route::get('/api/poligonos', [PoligonoController::class, 'getPoligonos']);

//API POLIGONO POR ID
Route::get('/api/poligonos/{id}', [PoligonoController::class, 'getPoligonoById'])->name('poligonos.show');

//API LOTES
Route::get('/api/lotes/{poligono}', [LoteController::class, 'getLotesByPoligono']);

//CRUD POLIGONOS
Route::get('/poligonos/edit', [PoligonoController::class, 'edit'])->name('edit'); 
Route::post('/poligonos/update', [PoligonoController::class, 'update'])->name('poligonos.update'); 

//MOSTRAR POLIGONO
Route::get('/poligonos/{id}', [PoligonoController::class, 'show'])->name('poligonos.show');

// API LOTES POR POLÍGONO
Route::get('/api/lotes/{poligono}', [LoteController::class, 'getLotesByPoligono'])->name('lotes.byPoligono');

// ACTUALIZAR LOTE
Route::post('/lotes/update/{id}', [LoteController::class, 'update'])->name('lotes.update');

// API LOTE POR ID
Route::get('/api/lote/{id}', [LoteController::class, 'getLoteById']);

