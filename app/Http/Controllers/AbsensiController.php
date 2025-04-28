<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKantor;
use App\Models\Attendance;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function viewPresensi() {
        $lokasiKantor = LokasiKantor::all();
        return view('user.user_home',  compact('lokasiKantor'));
    }

    public function viewKehadiran() {
        $absensi = Attendance::all();
        $today = Carbon::now()->translatedFormat('l, d F Y'); 
        return view('dashboard.kehadiran_pegawai', compact('absensi', 'today'));
    }

}
