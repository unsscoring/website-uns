<?php

use App\Http\Controllers\GuestController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminKejuaraan;
use App\Livewire\Admin\AdminKejuaraanCreate;
use App\Livewire\Admin\AdminKejuaraanUpdate\AdminKejuaraanUpdateContact;
use App\Livewire\Admin\AdminKejuaraanUpdate\AdminKejuaraanUpdateInformasi;
use App\Livewire\Admin\AdminKejuaraanUpdate\AdminKejuaraanUpdateKategori;
use App\Livewire\Admin\AdminKejuaraanUpdate\AdminKejuaraanUpdateLampiran;
use App\Livewire\Admin\AdminVerifikasi;
use App\Livewire\Admin\AdminVerifikasi\AdminVerifikasiAtlet;
use App\Livewire\Admin\AdminVerifikasi\AdminVerifikasiKejuaraan;
use App\Livewire\Admin\AdminVerifikasi\AdminVerifikasiKontingen;
use App\Livewire\Admin\AdminVerifikasi\AdminVerifikasiPembayaran;
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
use App\Livewire\Superadmin\SuperadminVerifikasi;
use App\Livewire\Superadmin\SuperadminVerifikasi\SuperadminVerifikasiAtlet;
use App\Livewire\Superadmin\SuperadminVerifikasi\SuperadminVerifikasiKejuaraan;
use App\Livewire\Superadmin\SuperadminVerifikasi\SuperadminVerifikasiKontingen;
use App\Livewire\Superadmin\SuperadminVerifikasi\SuperadminVerifikasiPembayaran;
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
    Route::get('/superadmin/verifikasi', SuperadminVerifikasi::class)->name('superadmin.verifikasi');
    Route::get('/superadmin/verifikasi/{kejuaraan}', SuperadminVerifikasiKejuaraan::class)->name('superadmin.verifikasi.kejuaraan');
    Route::get('/superadmin/verifikasi/{kontingen}/kontingen', SuperadminVerifikasiKontingen::class)->name('manajer.kejuaraan.kontingen');
    Route::get('/superadmin/verifikasi/{kontingen}/atlet', SuperadminVerifikasiAtlet::class)->name('manajer.kejuaraan.atlet');
    Route::get('/superadmin/verifikasi/{kontingen}/pembayaran', SuperadminVerifikasiPembayaran::class)->name('manajer.kejuaraan.pembayaran');
});
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/kejuaraan', AdminKejuaraan::class)->name('admin.kejuaraan');
    Route::get('/admin/kejuaraan-create', AdminKejuaraanCreate::class)->name('admin.kejuaraan-create');
    Route::get('/admin/kejuaraan-update/{kejuaraan}/informasi', AdminKejuaraanUpdateInformasi::class)->name('admin.kejuaraan-update.informasi');
    Route::get('/admin/kejuaraan-update/{kejuaraan}/contact', AdminKejuaraanUpdateContact::class)->name('admin.kejuaraan-update.contact');
    Route::get('/admin/kejuaraan-update/{kejuaraan}/lampiran', AdminKejuaraanUpdateLampiran::class)->name('admin.kejuaraan-update.lampiran');
    Route::get('/admin/kejuaraan-update/{kejuaraan}/kategori', AdminKejuaraanUpdateKategori::class)->name('admin.kejuaraan-update.kategori');
    Route::get('/admin/verifikasi', AdminVerifikasi::class)->name('admin.verifikasi');
    Route::get('/admin/verifikasi/{kejuaraan}', AdminVerifikasiKejuaraan::class)->name('admin.verifikasi.kejuaraan');
    Route::get('/admin/verifikasi/{kontingen}/kontingen', AdminVerifikasiKontingen::class)->name('manajer.kejuaraan.kontingen');
    Route::get('/admin/verifikasi/{kontingen}/atlet', AdminVerifikasiAtlet::class)->name('manajer.kejuaraan.atlet');
    Route::get('/admin/verifikasi/{kontingen}/pembayaran', AdminVerifikasiPembayaran::class)->name('manajer.kejuaraan.pembayaran');
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