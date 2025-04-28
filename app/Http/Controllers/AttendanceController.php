<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\Attendance;
use App\Models\LokasiKantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function viewKehadiran() {
        $today = Carbon::now()->translatedFormat('l, d F Y'); 
        $absensi = Attendance::where('date', $today)->get();
        return view('dashboard.kehadiran_pegawai', compact('absensi', 'today'));
    }
    
    public function viewAttendance() {
        $user = Auth::user();
        $kantor = LokasiKantor::first();
        return view('user.user_home', compact('user', 'kantor'));
    }
    
    public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        $pegawai = $user->pegawai;
        if (!$pegawai) {
            return response()->json(['message' => 'User tidak memiliki data pegawai'], 403);
        }

        $kantor = LokasiKantor::first(); // Ambil lokasi kantor (bisa disesuaikan jika ada lebih dari satu kantor)
        if (!$kantor) {
            return response()->json(['message' => 'Lokasi kantor tidak ditemukan'], 404);
        }

        $distance = $this->haversineDistance($kantor->latitude, $kantor->longitude, $request->latitude, $request->longitude);
        if ($distance > $kantor->radius) {
            return response()->json(['message' => 'Anda berada di luar area kantor'], 403);
        }

        $attendance = Attendance::create([
            'pegawai_id' => $pegawai->id,
            'date' => $request->date,
            'check_in' => $request->check_in,
            'check_out' => '-',
            'status' => 'hadir',
            'kantor_id' => $kantor->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['message' => 'Absensi berhasil', 'data' => $attendance]);
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;
        if (!$pegawai) {
            return response()->json(['message' => 'User tidak memiliki data pegawai'], 403);
        }

        $attendance = Attendance::where('pegawai_id', $pegawai->id)
            ->where('date', $request->date)
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Anda belum melakukan check-in hari ini'], 403);
        }

        if ($attendance->check_out !== "-") {
            return response()->json(['message' => 'Anda sudah melakukan check-out'], 403);
        }

        $attendance->update([
            'check_out' => $request->check_out,
        ]);

        return response()->json(['message' => 'Check-out berhasil', 'data' => $attendance]);
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Meter
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}