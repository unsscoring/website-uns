<?php

use App\Livewire\Guest\HomeController;
use App\Livewire\Manajer\ManajerDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('welcome');
Route::middleware(['role:manajer'])->group(function () {
    Route::get('/manajer/dashboard', ManajerDashboard::class)->name('manajer.dashboard');
    // Route::get('/manajer/kontingen', ManajerKontingen::class)->name('manajer.kontingen');
    // Route::get('/manajer/atlet', ManajerAtlet::class)->name('manajer.atlet');
    // Route::get('/manajer/atlet/create', ManajerAtletCreate::class)->name('manajer.atlet.create');
    // Route::get('/manajer/atlet/update/{atlet}', ManajerAtletUpdate::class)->name('manajer.atlet.update');
    // Route::get('/manajer/pembayaran', ManajerPembayaran::class)->name('manajer.pembayaran');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');