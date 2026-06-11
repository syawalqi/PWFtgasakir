<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik aduan khusus milik user yang sedang login
        $total     = Complaint::where('user_id', auth()->id())->count();
        $pending   = Complaint::where('user_id', auth()->id())->where('status', 'pending')->count();
        
        // FIX NAMA VARIABEL: Diubah menjadi $diproses agar sinkron dengan baris 22 di user/dashboard.blade.php
        $diproses  = Complaint::where('user_id', auth()->id())->where('status', 'proses')->count();
        
        $selesai   = Complaint::where('user_id', auth()->id())->where('status', 'selesai')->count();

        // Mengambil histori aduan terakhir milik user tersebut
        $aduanSaya = Complaint::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('total', 'pending', 'diproses', 'selesai', 'aduanSaya'));
    }
}