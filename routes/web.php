<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\OmieController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth', 'as' => 'dashboard.'], function () {
    Route::group(['prefix' => 'omie', 'as' => 'omie.'], function () {
        Route::controller(OmieController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('graficos', 'graficos')->name('graficos');
            Route::post('/', 'import')->name('import')->middleware('isAdmin');
            Route::post('/fluxo', 'importFluxo')->name('import-fluxo')->middleware('isAdmin');
            Route::get('/fluxo/{empresa}/download', 'downloadFluxo')->name('download-fluxo');
        });
    });

    Route::group(['prefix' => 'empresas', 'as' => 'empresa.', 'middleware' => 'isAdmin'], function () {
        Route::controller(EmpresaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    Route::group(['prefix' => 'usuarios', 'as' => 'usuario.', 'middleware' => 'isAdmin'], function () {
        Route::controller(UsuarioController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});

require __DIR__ . '/auth.php';
