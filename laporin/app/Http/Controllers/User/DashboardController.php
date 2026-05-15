<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $total = Complaint::where('user_id', $userId)->count();
        $pending = Complaint::where('user_id', $userId)->where('status', 'pending')->count();
        $diproses = Complaint::where('user_id', $userId)->where('status', 'diproses')->count();
        $selesai = Complaint::where('user_id', $userId)->where('status', 'selesai')->count();

        return view('user.dashboard', compact('total', 'pending', 'diproses', 'selesai'));
    }
}
