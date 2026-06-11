<?php

namespace App\Http\Controllers\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstructorDashboardController extends Controller
{
    public function index()
    {
        $total   = Complaint::where('status', 'proses')->count();
        $selesai = Complaint::whereIn('status', ['review', 'selesai'])->count();

        $tugasLapangan = Complaint::with(['user', 'category', 'responses.user'])
            ->whereIn('status', ['proses', 'review', 'selesai'])
            ->latest()
            ->get();

        return view('constructor.dashboard', compact('total', 'selesai', 'tugasLapangan'));
    }

    public function updateStatus($id)
    {
        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status'     => 'review',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Notifikasi pekerjaan selesai berhasil dikirimkan ke Admin Pusat!');
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:3',
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->responses()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
