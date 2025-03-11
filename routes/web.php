<?php

use Illuminate\Support\Facades\Route;

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