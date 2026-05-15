<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Complaint::count();
        $pending = Complaint::where('status', 'pending')->count();
        $diproses = Complaint::where('status', 'diproses')->count();
        $selesai = Complaint::where('status', 'selesai')->count();
        $recentComplaints = Complaint::with('user', 'category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('total', 'pending', 'diproses', 'selesai', 'recentComplaints'));
    }
}
