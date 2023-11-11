<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/qr{id}', [QrCodeController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespase' => 'Hall'], function () {
    Route::get('/hall', App\Http\Controllers\Hall\IndexController::class)->name('hall.index');
});

Route::group(['namespase' => 'Movie'], function () {
    Route::get('/movie', App\Http\Controllers\Movie\IndexController::class)->name('movie.index');
});

Route::group(['namespase' => 'Session'], function () {
    Route::get('/session', App\Http\Controllers\Session\IndexController::class)->name('session.index');
});

Route::group(['namespase' => 'Place'], function () {
    Route::get('/place', App\Http\Controllers\Place\IndexController::class)->name('place.index');
});

Route::group(['namespase' => 'Ticket'], function () {
    Route::get('/ticket', App\Http\Controllers\Ticket\IndexController::class)->name('ticket.index');
    Route::post('/ticket', App\Http\Controllers\Ticket\StoreController::class)->name('ticket.store');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::group(['namespase' => 'Hall'], function () {
            Route::post('/hall', App\Http\Controllers\Hall\StoreController::class)->name('hall.store');
            Route::delete('/hall{id}', App\Http\Controllers\Hall\DeleteController::class)->name('hall.delete');
            Route::put('/hall{id}', App\Http\Controllers\Hall\UpdateController::class)->name('hall.update');
            Route::patch('/hall{id}', App\Http\Controllers\Hall\UpdatePriceController::class)->name('hall.updatePrice');
            Route::put('/hall/active{value}{valueNew}', App\Http\Controllers\Hall\UpdateActiveController::class)->name('hall.updateActive');
        });
        Route::group(['namespase' => 'Place'], function () {
            Route::post('/place', App\Http\Controllers\Place\StoreController::class)->name('place.store');
            Route::patch('/place{id}', App\Http\Controllers\Place\UpdateController::class)->name('place.update');
        });
        Route::group(['namespase' => 'Movie'], function () {
            Route::post('/movie', App\Http\Controllers\Movie\StoreController::class)->name('movie.store');
            Route::delete('/movie{id}', App\Http\Controllers\Movie\DeleteController::class)->name('movie.delete');
        });
        Route::group(['namespase' => 'Session'], function () {
            Route::post('/session', App\Http\Controllers\Session\StoreController::class)->name('session.store');
            Route::patch('/session{id}', App\Http\Controllers\Session\UpdateController::class)->name('session.update');
        });
    });
});