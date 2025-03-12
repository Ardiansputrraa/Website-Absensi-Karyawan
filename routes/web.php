<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\DataRoleController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/kehadiran-pegawai', function () {
    return view('dashboard.kehadiran_pegawai');
});

Route::get('/data-pegawai', function () {
    return view('dashboard.data_pegawai');
});

Route::controller(DataJabatanController::class)->group(function () {
    Route::get('data-jabatan', 'viewDataJabatan')->name('data.jabatan');
    Route::post('tambah-jabatan', 'tambahJabatan')->name('tambah.jabatan');
    Route::get('detail-jabatan/{jabatan_id}', 'detailJabatan')->name('detail.jabatan');
    Route::post('edit-jabatan', 'editJabatan')->name('edit.jabatan');
    Route::get('delete-jabatan/{jabatan_id}', 'deleteJabatan')->name('delete.jabatan');
});

Route::controller(DataRoleController::class)->group(function () {
    Route::get('data-role', 'viewDataRole')->name('data.role');
    Route::post('tambah-role', 'tambahRole')->name('tambah.role');
    Route::get('detail-role/{role_id}', 'detailRole')->name('detail.role');
    Route::post('edit-role', 'editRole')->name('edit.role');
    Route::get('delete-role/{role_id}', 'deleteRole')->name('delete.role');
});

Route::get('/rekap-presensi-harian', function () {
    return view('dashboard.rekap_presensi_harian');
});

Route::get('/rekap-presensi-bulanan', function () {
    return view('dashboard.rekap_presensi_bulanan');
});

Route::get('/ketidakhadiran', function () {
    return view('dashboard.ketidakhadiran');
});

Route::get('/laporan-harian', function () {
    return view('dashboard.laporan_harian');
});

Route::get('/user-home', function () {
    return view('user.user_home');
});

Route::get('/user-rekap-presensi-harian', function () {
    return view('user.user_rekap_presensi_harian');
});

Route::get('/user-rekap-presensi-bulanan', function () {
    return view('user.user_rekap_presensi_bulanan');
});

Route::get('/user-ketidakhadiran', function () {
    return view('user.user_ketidakhadiran');
});

Route::get('/user-laporan-harian', function () {
    return view('user.user_laporan_harian');
});