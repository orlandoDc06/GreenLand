<?php
use App\Models\Lote;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoligonoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoteController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('home');
});

Route::get('/mapa', function () {
    return view('maps');
})->name('mapa');


//LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//LOGOUT
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

//REGISTER
Route::view('/register', 'register')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

//API POLIGONOS
Route::get('/api/poligonos', [PoligonoController::class, 'getPoligonos']);

//API POLIGONO POR ID
Route::get('/api/poligonos/{id}', [PoligonoController::class, 'getPoligonoById'])->name('poligonos.show');

//API LOTES
Route::get('/api/lotes/{poligono}', [LoteController::class, 'getLotesByPoligono']);

//API LOTE POR ID
Route::get('/poligonos/edit', [PoligonoController::class, 'edit'], function (){
    if (Auth::check() && auth()->user()->hasAnyRole(['admin'])) {
        return view('/poligonos/edit');
    }
    return view('/');
})->middleware('auth')->name('edit');

Route::post('/poligonos/update', [PoligonoController::class, 'update'], function (){
    if (Auth::check() && auth()->user()->hasAnyRole(['admin'])) {
        return view('/poligonos/update');
    }
    })
    ->middleware('auth')
    ->name('poligonos.update');

//MOSTRAR POLIGONO
Route::get('/poligonos/{id}', [PoligonoController::class, 'show'])->name('poligonos.show');

// API LOTES POR POLÍGONO
Route::get('/api/lotes/{poligono}', [LoteController::class, 'getLotesByPoligono'])->name('lotes.byPoligono');

// ACTUALIZAR LOTE
Route::post('/lotes/update/{id}', [LoteController::class, 'update'])->name('lotes.update');

// API LOTE POR ID
Route::get('/api/lote/{id}', [LoteController::class, 'getLoteById']);

// EDITAR MAPA
Route::get('/edit-map', [PoligonoController::class, 'editMap'])->middleware('auth')->name('edit.map');
Route::post('/poligono/update', [PoligonoController::class, 'updateMap'])->name('update.poligono');
