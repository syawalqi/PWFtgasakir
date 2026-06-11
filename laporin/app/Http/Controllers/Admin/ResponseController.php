<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, $complaintId)
    {
        $request->validate([
            'response' => 'required|string|min:5',
        ]);

        $complaint = Complaint::findOrFail($complaintId);

        $complaint->responses()->create([
            'user_id' => auth()->id(),
            'message' => $request->response,
        ]);

        $complaint->update([
            'status' => 'proses'
        ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Laporan berhasil ditanggapi dan dialihkan ke Tim Konstruktor Lapangan!');
    }
}
