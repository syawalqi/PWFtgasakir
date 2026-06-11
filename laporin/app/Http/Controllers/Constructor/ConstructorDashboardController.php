<?php

namespace App\Http\Controllers\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstructorDashboardController extends Controller
{
    public function index()
    {
        $total   = Complaint::where('status', 'proses')->count();
        $selesai = Complaint::whereIn('status', ['review', 'selesai'])->count();

        $tugasLapangan = Complaint::with(['user', 'category'])
            ->whereIn('status', ['proses', 'review', 'selesai'])
            ->latest()
            ->get();

        return view('constructor.dashboard', compact('total', 'selesai', 'tugasLapangan'));
    }

    public function updateStatus($id)
    {
        // Gunakan DB native agar aman dari casting model
        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status'     => 'review',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Notifikasi pekerjaan selesai berhasil dikirimkan ke Admin Pusat!');
    }
}