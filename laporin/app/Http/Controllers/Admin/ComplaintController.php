<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ComplaintController extends Controller
{
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

    public function show(Complaint $complaint)
    {
        $complaint->load('user', 'category', 'responses.user');
        return view('admin.complaints.show', compact('complaint'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => ['required', 'in:pending,diproses,selesai'],
        ]);

        $complaint->update(['status' => $request->status]);
        Cache::forget('admin_stats');

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Status aduan berhasil diperbarui.');
    }
}
