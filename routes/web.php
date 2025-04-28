<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataRoleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\LokasiKantorController;
use App\Http\Controllers\KetidakhadiranController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\RekapPresensiController;

Route::get('/', function () {
    return view('auth.login');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'viewLogin')->name('login');
    Route::post('login-check', 'loginCheck')->name('login.check');
    Route::post('logout', 'logout')->name('logout');
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

    Route::get('kehadiran-pegawai', 'viewKehadiran')->name('kehadiran.pegawai');
});

Route::controller(KetidakhadiranController::class)->group(function () {
    Route::get('user-ketidakhadiran', 'viewKetidakHadiran')->name('user.ketidakhadiran');
    Route::post('tambah-ketidakhadiran', 'tambahKetidakHadiran')->name('tambah.ketidakhadiran');
    Route::get('detail-ketidakhadiran/{ketidakhadiran_id}', 'detailKetidakHadiran')->name('detail.ketidakhadiran');
    Route::post('edit-ketidakhadiran', 'editKetidakHadiran')->name('edit.ketidakhadiran');
    Route::get('delete-ketidakhadiran/{ketidakhadiran_id}', 'deleteKetidakHadiran')->name('delete.ketidakhadiran');
    Route::get('download-ketidakhadiran/{ketidakhadiran_id}', 'downloadKetidakHadiran')->name('download.ketidakhadiran');

    Route::get('ketidakhadiran', 'viewKAdminKetidakHadiran')->name('ketidakhadiran');
    Route::post('setuju-ketidakhadiran', 'setujuKetidakhadiran')->name('setuju.ketidakhadiran');
    Route::get('ketidakhadiran-search', 'search')->name('ketidakhadiran.search');
});

Route::controller(LogbookController::class)->group(function () {
    Route::get('user-logbook', 'viewLogbook')->name('user.logbook');
    Route::post('tambah-logbook', 'tambahLogbook')->name('tambah.logbook');
    Route::get('detail-logbook/{logbook_id}', 'detailLogbook')->name('detail.logbook');
    Route::post('edit-logbook', 'editLogbook')->name('edit.logbook');
    Route::get('delete-logbook/{logbook_id}', 'deleteLogbook')->name('delete.logbook');
    Route::get('download-logbook/{logbook_id}', 'downloadLogbook')->name('download.logbook');

    Route::get('laporan-logbook', 'viewAdminLogbook')->name('laporan.logbook');
    Route::get('logbook-search', 'search')->name('logbook.search');
});

Route::controller(RekapPresensiController::class)->group(function () {
    Route::get('/user-rekap-presensi-harian', 'viewAbsensiHarian')->name('user.rekap.presensi.harian');
    Route::get('/rekap-presensi-harian', 'viewAdminAbsensiHarian')->name('rekap.presensi.harian');

    Route::get('/user-rekap-presensi-bulanan', 'viewAbsensiBulanan')->name('user.rekap.presensi.bulanan');
    Route::get('/rekap-presensi-bulanan', 'viewAdminAbsensiBulanan')->name('rekap.presensi.bulanan');

    Route::get('search-laporan-harian', 'searchLaporanHarian')->name('search.laporan.harian');
});
