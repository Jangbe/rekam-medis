<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PemeriksaanController;
use Illuminate\Support\Facades\Auth;
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
Route::redirect('/', 'login');
Auth::routes(['register'=>false]);

Route::middleware('auth')->group(function(){
    Route::view('profile', 'auth.profile');
    Route::put('profile/change-profile', [HomeController::class, 'change_profile']);
    Route::put('profile/change-password', [HomeController::class, 'change_password']);
});

Route::prefix('apoteker')->middleware(['auth','role:apoteker'])->group(function () {
    Route::get('obat/ajax', [ObatController::class, 'ajax']);
    Route::resource('obat', ObatController::class);
    Route::put('update-stok-obat/{obat}', [ObatController::class, 'update_stock']);
    Route::get('pemberian-obat', [ObatController::class, 'receipt']);
    Route::get('pemberian-obat/{med_rec}', [ObatController::class, 'show_receipt']);
});

Route::prefix('pegawai')->middleware(['auth','role:pegawai'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::get('patients/{patient:no_rm}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::post('medical-records/{patient}/surat-sakit', [MedicalRecordController::class, 'surat_sakit'])->name('med-rec.surat-sakit');
    Route::get('medical-records/{patient}/surat-rujukan', [MedicalRecordController::class, 'surat_rujukan'])->name('med-rec.surat-rujukan');
    Route::get('medical-records/laporan', [MedicalRecordController::class, 'laporan'])->name('med-rec.laporan');
    Route::put('medical-records/laporan', [MedicalRecordController::class, 'export'])->name('med-rec.export');
    Route::resource('medical-records', MedicalRecordController::class)->only('index','create','store');
});

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function(){
    Route::get('medical-records', [MedicalRecordController::class, 'index']);
    Route::resource('pemeriksaan', PemeriksaanController::class)->only('index','show','update');
    Route::post('pemeriksaan/{pemeriksaan}/resep', [PemeriksaanController::class, 'receipt'])->name('pemeriksaan.receipt');
    Route::get('pemeriksaan/{pemeriksaan}/resep', [PemeriksaanController::class, 'show_receipt'])->name('pemeriksaan.receipt');
});

Route::get('data-static-med-rec', [HomeController::class, 'data_static_med_rec']);
Route::get('data-static-patient', [HomeController::class, 'data_static_patient']);
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
