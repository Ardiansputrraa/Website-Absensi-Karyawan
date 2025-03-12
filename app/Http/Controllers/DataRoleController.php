<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class DataRoleController extends Controller
{
    public function viewDataRole()
    {
        $roles = Roles::all();
        return view('dashboard.data_role', compact('roles'));
    }

    public function tambahRole(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = Roles::create([
            'role' => $request->role,
        ]);

    
        return response()->json(['success' => 'Role berhasil ditambahkan.'], 200);
    }

    public function detailRole($id)
    {
        try {
            $role = Roles::findOrFail($id);
            return response()->json(['data' => $role], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editRole(Request $request)
{
    $validator = Validator::make($request->all(), [
        'role' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $id = $request->id;

    // Mencari Role berdasarkan ID
    $role = Roles::find($id);

    if (!$role) {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    // Update Role
    $role->role = $request->role;
    $role->save(); // Simpan perubahan

    return response()->json(['success' => 'Role berhasil diubah.'], 200);
}

function deleteRole($id)
    {
        $role = Roles::find($id);
        if ($role) {
            $role->delete();
        }
        return response()->json(['success' => 'Role berhasil dihapus.'], 200);
    }
}
