<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataPegawaiController extends Controller
{
    public function viewDataPegawai(Request $request, User $User)
    {

        // $this->authorize('viewRegister', User::class);
        $pegawais = Pegawai::all();
        $jabatans = Jabatan::all();
        $roles = Role::all();
        return view('dashboard.data_pegawai', compact('pegawais', 'jabatans', 'roles'));
    }

    public function tambahPegawai(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => "user",
        ]);
        Pegawai::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'image' => 'storage/images/profiles/profile.jpeg',
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'position' => $request->position,
            'role' => $request->role,
        ]);
        return response()->json(['success' => 'Data pegawai berhasil ditambahkan.'], 200);
    }

    public function detailPegawai($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            return response()->json(['data' => $pegawai], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editPegawai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'position' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $id = $request->id;

        // Mencari jabatan berdasarkan ID
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Update jabatan
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->phone_number = $request->phone_number;
        $pegawai->position = $request->position;
        $pegawai->role = $request->role;

        $pegawai->save(); // Simpan perubahan

        return response()->json(['success' => 'Jabatan berhasil diubah.'], 200);
    }

    function deletePegawai($id)
    {
        
        DB::beginTransaction();
        try {
            Pegawai::where('user_id', $id)->delete();

            User::where('id', $id)->delete();

            DB::commit();
            return response()->json(['message' => 'Pegawai berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
