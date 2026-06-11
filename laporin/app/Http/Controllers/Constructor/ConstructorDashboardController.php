<?php

namespace App\Http\Controllers\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ConstructorDashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard konstruktor beserta tugasnya.
     */
    public function index()
    {
        // Mengambil aduan yang dialokasikan khusus ke konstruktor (status: assigned_to_constructor)
        $complaints = Complaint::with('category')->where('status', 'assigned_to_constructor')->get();
        
        return view('constructor.dashboard', compact('complaints'));
    }

    /**
     * Aksi ketika konstruktor menekan tombol "Tandai Selesai"
     */
    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        
        // Ubah status menjadi laporan selesai versi konstruktor (menunggu validasi final admin)
        $complaint->update([
            'status' => 'constructor_finished'
        ]);

        return redirect()->route('constructor.dashboard')->with('success', 'Laporan perbaikan lapangan berhasil dikirim ke Admin untuk verifikasi final.');
    }
}