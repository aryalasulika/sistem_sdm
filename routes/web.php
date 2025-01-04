<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AbsensiController;


Route::get('/', function () {
    return view('auth.login');
});




Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    Route::get('/cuti', [CutiController::class, 'cutiPage'])->name('cuti');
    Route::get('/tambah_cuti', [CutiController::class, 'tambahCuti'])->name('tambah_cuti');

    Route::get('/shift', [ShiftController::class, 'shift'])->name('shift');
    Route::get('/halamanupdateshift/{id}', [ShiftController::class, 'editShift'])->name('pageUpdateShift');
    Route::post('/data_shift', [ShiftController::class, 'data_shift'])->name('data_shift');
    Route::put('/updateShift/{id}', [ShiftController::class, 'updateShift'])->name('updateShift');
    Route::delete('/deleteShift/{id}', [ShiftController::class, 'deleteShift'])->name('deleteShift');

    Route::get('/klinik', [OfficeController::class, 'klinik'])->name('klinik');
    Route::get('/tambah_data', [OfficeController::class, 'klinik_shift'])->name('klinik_shift');
    Route::get('/halamanupdateoffice/{id}', [OfficeController::class, 'editKlinik'])->name('pageUpdateOffice');
    Route::post('/perusahaan_shift_create', [OfficeController::class, 'saveData'])->name('officeShiftCreate');
    Route::put('/updateKlinik/{id}', [OfficeController::class, 'updateKlinik'])->name('updateKlinik');
    Route::delete('/deleteKlinik/{id}', [OfficeController::class, 'deleteKlinik'])->name('deleteKlinik');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');

    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');

    Route::get('/absensi', [AbsensiController::class, 'absen'])->name('absen');
    Route::get('/userabsen', [AbsensiController::class, 'userabsen'])->name('userabsen');

});


