<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKantor;

class AbsensiController extends Controller
{
    public function viewPresensi() {
        $lokasiKantor = LokasiKantor::all();
        return view('user.user_home',  compact('lokasiKantor'));
    }
}
