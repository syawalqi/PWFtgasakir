<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_stats', 300, fn() => [
            'total'    => Complaint::count(),
            'pending'  => Complaint::where('status', 'pending')->count(),
            'diproses' => Complaint::where('status', 'diproses')->count(),
            'selesai'  => Complaint::where('status', 'selesai')->count(),
        ]);

        $recentComplaints = Complaint::with('user', 'category')->latest()->take(5)->get();

        return view('admin.dashboard', array_merge($stats, compact('recentComplaints')));
    }
}
