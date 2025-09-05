<?php

use App\Http\Controllers\GuestController;
use App\Livewire\Guest\HomeController;
use App\Livewire\Guest\KejuaraanDetail;
use App\Livewire\Manajer\ManajerDashboard;
use App\Livewire\Manajer\ManajerKejuaraan;
use App\Livewire\Manajer\ManajerKejuaraan\ManajerKejuaraanAtlet;
use App\Livewire\Manajer\ManajerKejuaraan\ManajerKejuaraanKontingen;
use App\Livewire\Manajer\ManajerKejuaraan\ManajerKejuaraanPembayaran;
use App\Livewire\Superadmin\SuperadminDashboard;
use App\Livewire\Superadmin\SuperadminKejuaraan;
use App\Livewire\Superadmin\SuperadminKejuaraanCreate;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateContact;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateInformasi;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateKategori;
use App\Livewire\Superadmin\SuperadminKejuaraanUpdate\SuperadminKejuaraanUpdateLampiran;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('welcome');
Route::get('/kejuaraan/{slug}', KejuaraanDetail::class)->name('kejuaraan-detail');
Route::middleware(['role:manajer'])->group(function () {
    Route::get('/manajer/dashboard', ManajerDashboard::class)->name('manajer.dashboard');
    Route::get('/manajer/kejuaraan', ManajerKejuaraan::class)->name('manajer.kejuaraan');
    Route::get('/manajer/kejuaraan/{kejuaraan}/kontingen', ManajerKejuaraanKontingen::class)->name('manajer.kejuaraan.kontingen');
    Route::get('/manajer/kejuaraan/{kejuaraan}/atlet', ManajerKejuaraanAtlet::class)->name('manajer.kejuaraan.atlet');
    Route::get('/manajer/kejuaraan/{kejuaraan}/pembayaran', ManajerKejuaraanPembayaran::class)->name('manajer.kejuaraan.pembayaran');
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