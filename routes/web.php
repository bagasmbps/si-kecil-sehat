<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\AntropometriController;
use App\Http\Controllers\PerkembanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImunisasiController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome', ['hideNavbar' => true]);
})->name('welcome');

/*
|--------------------------------------------------------------------------
| ROUTE YANG WAJIB LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE (BAWAAN LARAVEL)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | DATA ANAK (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::get('/data-anak', [AnakController::class, 'index'])
        ->name('anak.index');

    Route::post('/data-anak', [AnakController::class, 'store'])
        ->name('anak.store');

    Route::get('/data-anak/{anak}/edit', [AnakController::class, 'edit'])
        ->name('anak.edit');

    Route::put('/data-anak/{anak}', [AnakController::class, 'update'])
        ->name('anak.update');

    Route::delete('/data-anak/{anak}', [AnakController::class, 'destroy'])
        ->name('anak.destroy');

    /*
    |--------------------------------------------------------------------------
    | ANTROPOMETRI
    |--------------------------------------------------------------------------
    | - index  : form + riwayat
    | - store  : simpan & hitung IMT
    | - grafik : halaman grafik (TERPISAH)
    |--------------------------------------------------------------------------
    */
    Route::get('/antropometri', [AntropometriController::class, 'index'])
        ->name('antropometri.index');

    Route::post('/antropometri', [AntropometriController::class, 'store'])
        ->name('antropometri.store');

    Route::get('/antropometri/grafik', [AntropometriController::class, 'grafik'])
        ->name('antropometri.grafik');

    /*
    |--------------------------------------------------------------------------
    | PERKEMBANGAN ANAK (MILESTONE)
    |--------------------------------------------------------------------------
    */
    Route::get('/perkembangan', [PerkembanganController::class, 'index'])
        ->name('perkembangan.index');

    Route::post('/perkembangan', [PerkembanganController::class, 'store'])
        ->name('perkembangan.store');

    /*
    |--------------------------------------------------------------------------
    |IMUNISASI
    |--------------------------------------------------------------------------
    */
    Route::get('/imunisasi/{anak}', [ImunisasiController::class, 'show'])
    ->name('imunisasi.show');

    Route::post('/imunisasi/tandai', [ImunisasiController::class, 'tandaiSudah'])
    ->name('imunisasi.tandai');

    Route::post('/imunisasi/{anak}',[ImunisasiController::class, 'store'])
    ->name('imunisasi.store');

    Route::put('/imunisasi/{anak}/toggle/{imunisasi}',[ImunisasiController::class, 'toggle'])
    ->name('imunisasi.toggle');
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN, REGISTER, LOGOUT, DLL)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
