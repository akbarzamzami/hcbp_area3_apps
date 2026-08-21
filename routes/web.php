<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\IdpController;
use App\Http\Controllers\KmContentController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\SettingRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin_master'])->prefix('admin-master')->name('admin-master.')->group(function () {
    Route::view('/dashboard', 'admin-master.dashboard')->name('dashboard');
    Route::get('/idp/daftar', [IdpController::class, 'daftar'])->name('idp.daftar');
    Route::view('/idp/penetapan', 'admin-master.idp.penetapan')->name('idp.penetapan');
    Route::get('/idp/pemantauan', [IdpController::class, 'pemantauan'])->name('idp.pemantauan');
    Route::view('/idp/evaluasi', 'admin-master.idp.evaluasi')->name('idp.evaluasi');
    Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
    Route::get('/setting-role', [SettingRoleController::class, 'index'])->name('setting-role');
    Route::post('/setting-role', [SettingRoleController::class, 'store'])->name('setting-role.store');
    Route::put('/setting-role/{pengguna}', [SettingRoleController::class, 'update'])->name('setting-role.update');
    Route::delete('/setting-role/{pengguna}', [SettingRoleController::class, 'destroy'])->name('setting-role.destroy');
    Route::get('/km-content', [KmContentController::class, 'index'])->name('km-content');
});

Route::middleware(['auth', 'role:admin_area'])->prefix('admin-area')->name('admin-area.')->group(function () {
    Route::view('/dashboard', 'admin-area.dashboard')->name('dashboard');
    Route::get('/idp/daftar', [IdpController::class, 'daftarArea'])->name('idp.daftar');
    Route::view('/idp/penetapan', 'admin-area.idp.penetapan')->name('idp.penetapan');
    Route::get('/idp/pemantauan', [IdpController::class, 'pemantauanArea'])->name('idp.pemantauan');
    Route::view('/idp/evaluasi', 'admin-area.idp.evaluasi')->name('idp.evaluasi');
    Route::get('/sertifikat', [SertifikatController::class, 'indexArea'])->name('sertifikat');
});

Route::middleware(['auth', 'role:atasan'])->prefix('atasan')->name('atasan.')->group(function () {
    Route::get('/idp/daftar', [IdpController::class, 'daftarAtasan'])->name('idp.daftar');
    Route::get('/idp/daftar/template', [IdpController::class, 'downloadTemplateImportAtasan'])->name('idp.template');
    Route::post('/idp/daftar/import', [IdpController::class, 'importAtasan'])->name('idp.import');
    Route::post('/idp/daftar', [IdpController::class, 'storeAtasan'])->name('idp.store');
    Route::put('/idp/daftar/{idp}', [IdpController::class, 'updateAtasan'])->name('idp.update');
    Route::delete('/idp/daftar/{idp}', [IdpController::class, 'destroyAtasan'])->name('idp.destroy');
    Route::get('/idp/penetapan', [IdpController::class, 'penetapanAtasan'])->name('idp.penetapan');
    Route::put('/idp/penetapan/{rencana}', [IdpController::class, 'reviewRencanaAtasan'])->name('idp.penetapan.review');
    Route::get('/idp/pemantauan', [IdpController::class, 'pemantauanAtasan'])->name('idp.pemantauan');
    Route::put('/idp/pemantauan/{idp}', [IdpController::class, 'updatePemantauanAtasan'])->name('idp.pemantauan.update');
    Route::get('/idp/evaluasi', [EvaluasiController::class, 'evaluasiAtasan'])->name('idp.evaluasi');
    Route::post('/idp/evaluasi/{idp}', [EvaluasiController::class, 'storeEvaluasi'])->name('idp.evaluasi.store');
});

Route::middleware(['auth', 'role:bawahan'])->prefix('bawahan')->name('bawahan.')->group(function () {
    Route::view('/dashboard', 'bawahan.dashboard')->name('dashboard');
    Route::get('/idp/daftar', [IdpController::class, 'daftarBawahan'])->name('idp.daftar');
    Route::post('/idp/daftar/{idp}/rencana', [IdpController::class, 'storeRencanaBawahan'])->name('idp.rencana.store');
    Route::view('/idp/penetapan', 'bawahan.idp.penetapan')->name('idp.penetapan');
    Route::get('/idp/pemantauan', [IdpController::class, 'pemantauanBawahan'])->name('idp.pemantauan');
    Route::get('/idp/evaluasi', [IdpController::class, 'evaluasiBawahan'])->name('idp.evaluasi');
    Route::get('/sertifikat', [SertifikatController::class, 'indexBawahan'])->name('sertifikat');
});
