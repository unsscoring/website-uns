<?php

use App\Http\Controllers\GuestController;
use App\Livewire\Guest\HomeController;
use App\Livewire\Manajer\ManajerDashboard;
use App\Livewire\Superadmin\SuperadminDashboard;
use App\Livewire\Superadmin\SuperadminKejuaraan;
use App\Livewire\Superadmin\SuperadminKejuaraanCreate;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateContact;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateInformasi;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateKategori;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateLampiran;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('welcome');
Route::middleware(['role:manajer'])->group(function () {
    Route::get('/manajer/dashboard', ManajerDashboard::class)->name('manajer.dashboard');
});
Route::middleware(['role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', SuperadminDashboard::class)->name('superadmin.dashboard');
    Route::get('/superadmin/kejuaraan', SuperadminKejuaraan::class)->name('superadmin.kejuaraan');
    Route::get('/superadmin/kejuaraan-create', SuperadminKejuaraanCreate::class)->name('superadmin.kejuaraan-create');
    Route::get('/superadmin/kejuaraan-update/{kejuaraan}/informasi', SuperadminKejuaraanUpdateInformasi::class)->name('superadmin.kejuaraan-update.informasi');
    Route::get('/superadmin/kejuaraan-update/{kejuaraan}/contact', SuperadminKejuaraanUpdateContact::class)->name('superadmin.kejuaraan-update.contact');
    Route::get('/superadmin/kejuaraan-update/{kejuaraan}/lampiran', SuperadminKejuaraanUpdateLampiran::class)->name('superadmin.kejuaraan-update.lampiran');
    Route::get('/superadmin/kejuaraan-update/{kejuaraan}/kategori', SuperadminKejuaraanUpdateKategori::class)->name('superadmin.kejuaraan-update.kategori');
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