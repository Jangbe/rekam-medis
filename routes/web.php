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
Route::view('table', 'table')->middleware(['auth','role:admin,apoteker']);

Auth::routes(['register'=>false]);
Route::view('profile', 'auth.profile')->middleware('auth');
Route::prefix('apoteker')->middleware(['auth','role:apoteker'])->group(function () {
    Route::get('obat/ajax', [ObatController::class, 'ajax']);
    Route::resource('obat', ObatController::class);
    Route::get('pemberian-obat', [ObatController::class, 'receipt']);
});

Route::prefix('pegawai')->middleware(['auth','role:pegawai'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('medical-records', MedicalRecordController::class)->only('index','create','store');
});

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function(){
    Route::get('medical-records', [MedicalRecordController::class, 'index']);
    Route::get('pemeriksaan', [MedicalRecordController::class, 'pemeriksaan']);
    Route::post('pemeriksaan', [MedicalRecordController::class, 'pemeriksaan']);
    Route::get('resep', [MedicalRecordController::class, 'receipt']);
    Route::post('resep', [MedicalRecordController::class, 'receipt']);
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
