<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class DataJabatanController extends Controller
{
    public function viewDataJabatan()
    {
        $jabatans = Jabatan::all();
        return view('dashboard.data_jabatan', compact('jabatans'));
    }

    public function tambahJabatan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jabatan = Jabatan::create([
            'jabatan' => $request->jabatan,
        ]);

    
        return response()->json(['success' => 'Jabatan berhasil ditambahkan.'], 200);
    }

    public function detailJabatan($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);
            return response()->json(['data' => $jabatan], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editJabatan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'jabatan' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $id = $request->id;

    // Mencari jabatan berdasarkan ID
    $jabatan = Jabatan::find($id);

    if (!$jabatan) {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    // Update jabatan
    $jabatan->jabatan = $request->jabatan;
    $jabatan->save(); // Simpan perubahan

    return response()->json(['success' => 'Jabatan berhasil diubah.'], 200);
}

function deleteJabatan($id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan) {
            $jabatan->delete();
        }
        return response()->json(['success' => 'Jabatan berhasil dihapus.'], 200);
    }

}
