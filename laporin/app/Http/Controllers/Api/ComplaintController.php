<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua aduan dengan pagination
     */
    public function index()
    {
        // Menggunakan paginate() agar sesuai dengan method firstItem() di blade index
        $complaints = Complaint::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail aduan warga
     */
    public function show($id)
    {
        $complaint = Complaint::with(['user', 'category', 'responses'])->findOrFail($id);
        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Aksi Admin meneruskan keluhan warga ke tim konstruksi lapangan
     */
    public function forwardToConstructor($id)
    {
        $complaint = Complaint::findOrFail($id);
        
        // FIX ENUM: Menggunakan 'proses' sesuai dengan database MySQL kamu
        $complaint->update([
            'status' => 'proses'
        ]);

        return redirect()->back()->with('success', 'Aduan berhasil diteruskan ke tim konstruksi lapangan.');
    }

    /**
     * Aksi Admin menyetujui hasil kerja lapangan dan menutup laporan dengan tanggapan
     */
    public function finalizeComplaint(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|min:5',
        ]);

        $complaint = Complaint::findOrFail($id);

        // Menyimpan catatan tanggapan ke tabel responses
        $complaint->responses()->create([
            'user_id' => auth()->id(),
            'body'    => $request->response,
        ]);

        // FIX ENUM: Menggunakan 'selesai' sesuai dengan database MySQL kamu
        $complaint->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Laporan keluhan resmi ditutup dan dinyatakan Selesai!');
    }
}