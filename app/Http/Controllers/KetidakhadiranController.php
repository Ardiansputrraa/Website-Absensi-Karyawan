<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class KetidakhadiranController extends Controller
{
    public function viewKetidakHadiran()
    {
        $user = Auth::user();
        $pegawai_id = $user->pegawai->id;
        $leave_request = LeaveRequest::where('pegawai_id', $pegawai_id)->get();
        return view('user.user_ketidakhadiran', compact('leave_request'));
    }

    public function viewKAdminKetidakHadiran()
    {
        $leave_request = LeaveRequest::all();
        $pegawais = Pegawai::all();
        return view('dashboard.ketidakhadiran', compact('leave_request', 'pegawais'));
    }

    public function search(Request $request)
    {
        $pegawai_id = $request->input('pegawai_id');
        $start_date = $request->input('start_date');

        $query = LeaveRequest::query();

        if (!empty($pegawai_id)) {
            $query->where('pegawai_id', $pegawai_id);
        }

        if (!empty($start_date)) {
            $query->where('start_date', $start_date);
        }

        $leaveRequests = $query->get();

        return response()->json($leaveRequests);
    }

    public function setujuKetidakhadiran(Request $request)
    {
        $id = $request->id;
        $leave_request = LeaveRequest::find($id);
          
        $leave_request->update([
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Ketidakhadiran berhasil diterima.'], 200);
    }

    public function tambahKetidakHadiran(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            return response()->json(['message' => 'User tidak memiliki data pegawai'], 403);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = 'storage/images/ketidakhadiran/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $file->move(public_path('storage/images/ketidakhadiran'), $fileName);

        $leave_request = LeaveRequest::create([
            'pegawai_id' => $pegawai->id,
            'name' => $pegawai->name,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'file' => $filePath,
            'reason' => $request->reason,
        ]);


        return response()->json(['success' => ' Ketidakhadiran berhasil ditambahkan.'], 200);
    }

    public function detailKetidakHadiran($id)
    {
        try {
            $leave_request = LeaveRequest::findOrFail($id);
            return response()->json(['data' => $leave_request], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editKetidakHadiran(Request $request)
    {

        $id = $request->id;

        $leave_request = LeaveRequest::find($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'storage/image/ketidakhadiran/' . $fileName;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $file->move(public_path('storage/images/ketidakhadiran'), $fileName);

            $leave_request->update([
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'file' => $filePath,
                'reason' => $request->reason,
            ]);
        } else {
            $leave_request->update([
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
            ]);
        }

        return response()->json(['success' => 'Ketidakhadiran berhasil diubah.'], 200);
    }


    function deleteKetidakHadiran($id)
    {
        $leave_request = LeaveRequest::find($id);
        $filePath = public_path($leave_request->file);
        if ($leave_request) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $leave_request->delete();
        }
        return response()->json(['success' => 'Ketidakhadiran berhasil dihapus.'], 200);
    }

    public function downloadKetidakHadiran($id)
    {
        $leave_request = LeaveRequest::findOrFail($id);

        $filePath = public_path($leave_request->file);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }
    }
}
