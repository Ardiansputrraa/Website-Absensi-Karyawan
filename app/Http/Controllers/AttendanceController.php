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

    public function viewAttendance() {
        $user = Auth::user();
        $kantor = LokasiKantor::first();
        return view('user.user_home', compact('user', 'kantor'));
    }
    
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            return back()->with('error', 'Pegawai tidak ditemukan.');
        }

        // Ambil lokasi kantor
        $kantor = LokasiKantor::first();

        if (!$kantor) {
            return back()->with('error', 'Lokasi kantor tidak ditemukan.');
        }

        $userLatitude = $request->latitude;
        $userLongitude = $request->longitude;

        // Hitung jarak user dengan kantor
        $distance = $this->haversineGreatCircleDistance(
            $kantor->latitude, $kantor->longitude,
            $userLatitude, $userLongitude
        );

        // Cek apakah user berada dalam radius kantor
        if ($distance > $kantor->radius) {
            return back()->with('error', 'Anda berada di luar jangkauan kantor.');
        }

        // Simpan ke database
        Attendance::create([
            'pegawai_id' => $pegawai->id,
            'date' => Carbon::now()->toDateString(),
            'check_in' => Carbon::now()->toTimeString(),
            'status' => 'hadir',
            'kantor_id' => $kantor->id,
            'latitude' => $userLatitude,
            'longitude' => $userLongitude,
        ]);

        return back()->with('success', 'Absensi berhasil dilakukan.');
    }

    private function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $latDelta = $lat2 - $lat1;
        $lonDelta = $lon2 - $lon1;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($lonDelta / 2), 2)));

        return $earthRadius * $angle;
    }
}