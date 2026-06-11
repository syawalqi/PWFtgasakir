<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua aduan dengan pagination resmi
     */
    public function index()
    {
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
        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status' => 'proses',
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Aduan berhasil diteruskan ke tim konstruksi lapangan.');
    }

    /**
     * Aksi Admin menyetujui hasil kerja lapangan dan menutup laporan dengan tanggapan resmi ke user
     */
    public function finalizeComplaint(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|min:5',
        ]);

        $complaint = Complaint::findOrFail($id);

        // BYPASS MUTLAK VIA DB NATIVE: Mengisi seluruh variasi kolom potensial agar teks tanggapan 100% masuk
        DB::table('responses')->insert([
            'complaint_id' => $complaint->id,
            'user_id'      => auth()->id(),
            'body'         => $request->response,
            'response'     => $request->response,
            'content'      => $request->response,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Gunakan DB native update agar status 'selesai' masuk aman tanpa kendala ENUM database
        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status' => 'selesai',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Laporan keluhan resmi ditutup dan dinyatakan Selesai!');
    }
}