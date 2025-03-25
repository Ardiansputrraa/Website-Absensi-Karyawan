<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Pegawai;

class LogbookController extends Controller
{
    public function viewLogbook()
    {
        $user = Auth::user();
        $pegawai_id = $user->pegawai->id;
        $logbook = Logbook::where('pegawai_id', $pegawai_id)->get();
        return view('user.user_laporan_harian', compact('logbook'));
    }

    public function viewAdminLogbook()
    {
        $logbook = Logbook::all();
        $pegawais = Pegawai::all();
        return view('dashboard.laporan_harian', compact('logbook', 'pegawais'));
    }

    public function search(Request $request)
    {
        $pegawai_id = $request->input('pegawai_id');
        $date = $request->input('date');

        $query = Logbook::query();

        if (!empty($pegawai_id)) {
            $query->where('pegawai_id', $pegawai_id);
        }

        if (!empty($date)) {
            $query->where('date', $date);
        }

        $logbook = $query->get();

        return response()->json($logbook);
    }

    public function tambahLogbook(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            return response()->json(['message' => 'User tidak memiliki data pegawai'], 403);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = 'storage/images/logbook/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $file->move(public_path('storage/images/logbook'), $fileName);

        $logbook = Logbook::create([
            'pegawai_id' => $pegawai->id,
            'name' => $pegawai->name,
            'jabatan' => $pegawai->position,
            'date' => $request->date,
            'file' => $filePath,
            'deskripsi' => $request->deskripsi,
        ]);


        return response()->json(['success' => ' Laporan berhasil ditambahkan.'], 200);
    }

    public function detailLogbook($id)
    {
        try {
            $logbook = Logbook::findOrFail($id);
            return response()->json(['data' => $logbook], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editLogbook(Request $request)
    {

        $id = $request->id;

        $logbook = Logbook::find($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'storage/image/logbook/' . $fileName;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $file->move(public_path('storage/images/logbook'), $fileName);

            $logbook->update([
                'date' => $request->date,
                'file' => $filePath,
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            $logbook->update([
                'date' => $request->date,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return response()->json(['success' => 'Laporan berhasil diubah.'], 200);
    }


    function deleteLogbook($id)
    {
        $logbook = Logbook::find($id);
        $filePath = public_path($logbook->file);
        if ($logbook) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $logbook->delete();
        }
        return response()->json(['success' => 'Laporan berhasil dihapus.'], 200);
    }

    public function downloadLogbook($id)
    {
        $logbook = Logbook::findOrFail($id);

        $filePath = public_path($logbook->file);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }
    }
}
