<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/total-pegawai', function () {
    return view('dashboard.total_pegawai');
});

Route::get('/total-hadir', function () {
    return view('dashboard.total_hadir');
});