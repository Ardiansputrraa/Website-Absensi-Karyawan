<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataRoleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\LokasiKantorController;
use App\Http\Controllers\KetidakhadiranController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/kehadiran-pegawai', function () {
    return view('dashboard.kehadiran_pegawai');
});

Route::get('/data-pegawai', function () {
    return view('dashboard.data_pegawai');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'viewLogin')->name('login');
    Route::post('login-check', 'loginCheck')->name('login.check');
});

Route::controller(DataJabatanController::class)->group(function () {
    Route::get('data-jabatan', 'viewDataJabatan')->name('data.jabatan');
    Route::post('tambah-jabatan', 'tambahJabatan')->name('tambah.jabatan');
    Route::get('detail-jabatan/{jabatan_id}', 'detailJabatan')->name('detail.jabatan');
    Route::post('edit-jabatan', 'editJabatan')->name('edit.jabatan');
    Route::get('delete-jabatan/{jabatan_id}', 'deleteJabatan')->name('delete.jabatan');
});

Route::controller(DataPegawaiController::class)->group(function () {
    Route::get('data-pegawai', 'viewDataPegawai')->name('data.pegawai');
    Route::post('tambah-pegawai', 'tambahPegawai')->name('tambah.pegawai');
    Route::get('detail-pegawai/{pegawai_id}', 'detailPegawai')->name('detail.pegawai');
    Route::post('edit-pegawai', 'editPegawai')->name('edit.pegawai');
    Route::get('delete-pegawai/{pegawai_id}', 'deletePegawai')->name('delete.pegawai');
});


Route::controller(DataRoleController::class)->group(function () {
    Route::get('data-role', 'viewDataRole')->name('data.role');
    Route::post('tambah-role', 'tambahRole')->name('tambah.role');
    Route::get('detail-role/{role_id}', 'detailRole')->name('detail.role');
    Route::post('edit-role', 'editRole')->name('edit.role');
    Route::get('delete-role/{role_id}', 'deleteRole')->name('delete.role');
});

Route::controller(LokasiKantorController::class)->group(function () {
    Route::get('lokasi-kantor', 'viewLokasiKantor')->name('lokasi.kantor');
    Route::post('create-lokasi-kantor', 'createLokasiKantor')->name('create.lokasi.kantor');
    Route::get('detail-lokasi-kantor/{lokasi_id}', 'detailLokasiKantor')->name('detail.lokasi.kantor');
    Route::post('edit-lokasi-kantor', 'editLokasiKantor')->name('edit.lokasi.kantor');
    Route::get('delete-lokasi-kantor/{lokasi_id}', 'deleteLokasiKantor')->name('delete.lokasi.kantor');
});

Route::controller(AttendanceController::class)->group(function () {
    Route::get('user-home', 'viewAttendance')->name('user.home');
    Route::post('absen-masuk', 'checkIn')->name('absen.masuk');
    Route::post('absen-keluar', 'checkOut')->name('absen.keluar');
});

Route::controller(KetidakhadiranController::class)->group(function () {
    Route::get('user-ketidakhadiran', 'viewKetidakHadiran')->name('user-ketidakhadiran');
    Route::post('tambah-ketidakhadiran', 'tambahKetidakHadiran')->name('tambah.ketidakhadiran');
    Route::get('detail-ketidakhadiran/{ketidakhadiran_id}', 'detailKetidakHadiran')->name('detail.ketidakhadiran');
    Route::post('edit-ketidakhadiran', 'editKetidakhadiran')->name('edit.ketidakhadiran');
    Route::get('delete-ketidakhadiran/{ketidakhadiran_id}', 'deleteKetidakHadiran')->name('delete.ketidakhadiran');
    Route::get('download-ketidakhadiran/{ketidakhadiran_id}', 'downloadKetidakHadiran')->name('download.ketidakhadiran');
});

Route::get('/rekap-presensi-harian', function () {
    return view('dashboard.rekap_presensi_harian');
});

Route::get('/rekap-presensi-bulanan', function () {
    return view('dashboard.rekap_presensi_bulanan');
});


Route::get('/laporan-harian', function () {
    return view('dashboard.laporan_harian');
});


Route::get('/user-rekap-presensi-harian', function () {
    return view('user.user_rekap_presensi_harian');
});

Route::get('/user-rekap-presensi-bulanan', function () {
    return view('user.user_rekap_presensi_bulanan');
});

Route::get('/user-laporan-harian', function () {
    return view('user.user_laporan_harian');
});