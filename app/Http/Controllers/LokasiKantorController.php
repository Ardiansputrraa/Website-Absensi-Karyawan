<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKantor;
use Illuminate\Support\Facades\Validator;

class LokasiKantorController extends Controller {

    public function viewLokasiKantor() {
        $lokasiKantor = LokasiKantor::all();
        return view('dashboard.lokasi_kantor',  compact('lokasiKantor'));
    }

    public function createLokasiKantor(Request $request) {
        $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric|min:1',
        ]);

        LokasiKantor::create([
            'nama_kantor' => $request->nama_kantor,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
        ]);

        return response()->json(['success' => true, 'message' => 'Lokasi kantor berhasil disimpan!']);
    }

    public function detailLokasiKantor($id)
    {
        try {
            $lokasiKantor = LokasiKantor::findOrFail($id);
            return response()->json(['data' => $lokasiKantor], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editLokasiKantor(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $id = $request->id;
        $lokasiKantor = LokasiKantor::find($id);

        $lokasiKantor->nama_kantor = $request->nama_kantor;
        $lokasiKantor->alamat = $request->alamat;
        $lokasiKantor->latitude = $request->latitude;
        $lokasiKantor->longitude = $request->longitude;
        $lokasiKantor->radius = $request->radius;

        $lokasiKantor->save();

        return response()->json(['success' => 'Lokasi kantor berhasil diubah.'], 200);
    }

    function deleteLokasiKantor($id)
    {
        $lokasiKantor = LokasiKantor::find($id);
        if ($lokasiKantor) {
            $lokasiKantor->delete();
        }
        return response()->json(['success' => 'Lokasi Kantor berhasil dihapus.'], 200);
    }

}
