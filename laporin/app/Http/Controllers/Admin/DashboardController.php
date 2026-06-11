<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        // FIX SINKRONISASI: Menghitung riil data menggunakan ENUM bahasa Indonesia lokal ('proses', 'selesai')
        $total    = Complaint::count();
        $pending  = Complaint::where('status', 'pending')->count();
        $diproses = Complaint::where('status', 'proses')->count(); 
        $selesai  = Complaint::where('status', 'selesai')->count(); 

        $aduanTerbaru = Complaint::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('total', 'pending', 'diproses', 'selesai', 'aduanTerbaru'));
    }
}