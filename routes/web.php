<?php

use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'welcome');
Route::redirect('/', 'login');

Auth::routes(['register'=>false]);
Route::view('profile', 'auth.profile')->middleware('auth');
Route::prefix('apoteker')->middleware(['auth','role:apoteker'])->group(function () {
    Route::get('obat/ajax', [ObatController::class, 'ajax']);
    Route::resource('obat', ObatController::class);
    Route::put('update-stok-obat/{obat}', [ObatController::class, 'update_stock']);
    Route::get('pemberian-obat', [ObatController::class, 'receipt']);
});

Route::prefix('pegawai')->middleware(['auth','role:pegawai'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::post('medical-records/{patient}/surat-sakit', [MedicalRecordController::class, 'surat_sakit'])->name('med-rec.surat-sakit');
    Route::get('medical-records/{patient}/surat-rujukan', [MedicalRecordController::class, 'surat_rujukan'])->name('med-rec.surat-rujukan');
    Route::get('medical-records/laporan', [MedicalRecordController::class, 'laporan'])->name('med-rec.laporan');
    Route::put('medical-records/laporan/{type}', [MedicalRecordController::class, 'export'])->name('med-rec.export');
    Route::resource('medical-records', MedicalRecordController::class)->only('index','create','store');
});

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function(){
    Route::get('medical-records', [MedicalRecordController::class, 'index']);
    Route::get('pemeriksaan', [MedicalRecordController::class, 'pemeriksaan']);
    Route::post('pemeriksaan', [MedicalRecordController::class, 'pemeriksaan']);
    Route::get('resep', [MedicalRecordController::class, 'receipt']);
    Route::post('resep', [MedicalRecordController::class, 'receipt']);
});

Route::get('data-static-med-rec', [App\Http\Controllers\HomeController::class, 'data_static_med_rec']);
Route::get('data-static-patient', [App\Http\Controllers\HomeController::class, 'data_static_patient']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
