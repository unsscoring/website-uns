<?php

use App\Http\Controllers\GuestController;
use App\Livewire\Guest\HomeController;
use App\Livewire\Manajer\ManajerDashboard;
use App\Livewire\Superadmin\SuperadminDashboard;
use App\Livewire\Superadmin\SuperadminKejuaraan;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('welcome');
Route::middleware(['role:manajer'])->group(function () {
    Route::get('/manajer/dashboard', ManajerDashboard::class)->name('manajer.dashboard');
});
Route::middleware(['role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', SuperadminDashboard::class)->name('superadmin.dashboard');
    Route::get('/superadmin/kejuaraan', SuperadminKejuaraan::class)->name('superadmin.kejuaraan');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [GuestController::class, 'index'])->name('dashboard');  
});
Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');