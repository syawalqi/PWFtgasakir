<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response; // Sesuaikan dengan nama model tanggapan kelompokmu
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, $complaintId)
    {
        $request->validate([
            'response' => 'required|string|min:5',
        ]);

        $complaint = Complaint::findOrFail($complaintId);

        // 1. Simpan data tanggapan ke tabel responses
        // Jika kelompokmu memakai struktur form custom, sesuaikan fieldnya di bawah ini
        $complaint->responses()->create([
            'user_id' => auth()->id(),
            'body' => $request->response, // ganti 'body' jika nama kolom di database berbeda
        ]);

        // 2. KUNCI UTAMA: Otomatis alihkan status ke 'process' agar terkirim ke Konstruktor
        $complaint->update([
            'status' => 'process'
        ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Laporan berhasil ditanggapi dan dialihkan ke Tim Konstruktor Lapangan!');
    }
}