<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes`
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/login-walas', 'loginWalas');
    Route::post('/login-siswa', 'loginSiswa');
    Route::get('/dashboard', 'dashboard');
    Route::get('/logout', 'logout');
});

Route::middleware('CheckUserRole:Walas')->group(function () {
    Route::controller(NilaiController::class)
        ->prefix('nilai-raport')
        ->group(function () {
            Route::get('/index', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/edit/{nilai}', 'edit');
            Route::put('/update/{nilai}', 'update');
            Route::get('/destroy/{nilai}', 'destroy');
            Route::get('/show/{id}', 'showNilai');
            // Route::get('/', 'show');
        });
});

Route::get('nilai-raport/show', [NilaiController::class, 'showNilaiStudent']);
