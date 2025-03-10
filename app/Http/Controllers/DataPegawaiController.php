<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPegawaiController extends Controller
{
    public function viewDataPegawai(Request $request, User $User)
    {

        $this->authorize('viewRegister', User::class);

        $role = $request->query('role');
        return view('dashboard.data_pegawai', ['role' => $role]);
    }

    public function addDataPegawai(Request $request)
    {
        // $this->authorize('createAccount', User::class);

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'foto' => 'storage/images/profiles/profile.jpeg',
            ]);
        } else if ($request->role === 'user') {
            Mahasiswa::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'status' => 'belum terdaftar'
            ]);
        } else {
            return response()->json(['info' => 'Tentukan role akun terlebih dahulu.'], 200);
        }
        return response()->json(['success' => 'Registrasi berhasil.'], 200);
    }
}
