<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('alat.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('alat.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('alat', AlatController::class);
    Route::resource('peminjaman', PeminjamanController::class)->except(['show', 'edit']);
});

require __DIR__.'/auth.php';