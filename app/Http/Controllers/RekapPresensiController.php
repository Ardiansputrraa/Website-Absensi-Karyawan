<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Pegawai;
use Carbon\Carbon;

class RekapPresensiController extends Controller
{
    public function viewAbsensiHarian()
    {
        $user = Auth::user();
        $pegawai_id = $user->pegawai->id;
        $absensi = Attendance::where('pegawai_id', $pegawai_id)->get();
        return view('user.user_rekap_presensi_harian', compact('absensi'));
    }

    public function viewAdminAbsensiHarian()
    {
        $absensi = Attendance::with('pegawai')->get();
        $pegawais = Pegawai::all();
        return view('dashboard.rekap_presensi_harian', compact('absensi', 'pegawais'));
    }

    public function viewAbsensiBulanan()
    {
        $user = Auth::user();
        $pegawai_id = $user->pegawai->id;
        $absensi = Attendance::where('pegawai_id', $pegawai_id)->get();
        return view('user.user_rekap_presensi_bulanan', compact('absensi'));
    }

    public function viewAdminAbsensiBulanan()
    {
        $absensi = Attendance::with('pegawai')->get();
        $pegawais = Pegawai::all();
        return view('dashboard.rekap_presensi_bulanan', compact('absensi', 'pegawais'));
    }

    public function searchLaporanHarian(Request $request)
    {
        $tanggal = $request->input('tanggal'); 

        $absensi = Attendance::with('pegawai')
            ->where('date', $tanggal)
            ->get();

        return response()->json($absensi);
    }
}
