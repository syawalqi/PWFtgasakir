<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua aduan masuk dengan fitur filter dan search.
     */
    public function index(Request $request)
    {
        $query = Complaint::with('user', 'category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $complaints = $query->latest()->paginate(10)->withQueryString();

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail pengaduan beserta riwayat tanggapan (responses).
     */
    public function show(Complaint $complaint)
    {
        $complaint->load('user', 'category', 'responses.user');
        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Mengubah status aduan (Aksi dari sisi panel Admin).
     */
    public function updateStatus(Request $request, Complaint $complaint)
    {
        // FIX: Memasukkan status baru untuk Konstruktor ke dalam aturan validasi
        $request->validate([
            'status' => [
                'required', 
                'in:pending,assigned_to_constructor,constructor_finished,selesai,diproses'
            ],
        ]);

        // Memperbarui data status di database
        $complaint->update(['status' => $request->status]);
        
        // Mempertahankan pembersihan cache statistik bawaan sistem kelompokmu
        Cache::forget('admin_stats');

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Status aduan berhasil diperbarui.');
    }
}