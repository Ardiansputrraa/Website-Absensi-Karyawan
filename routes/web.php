<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/kehadiran-pegawai', function () {
    return view('dashboard.kehadiran_pegawai');
});

Route::get('/data-pegawai', function () {
    return view('dashboard.data_pegawai');
});

Route::get('/data-jabatan', function () {
    return view('dashboard.data_jabatan');
});

Route::get('/data-role', function () {
    return view('dashboard.data_role');
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