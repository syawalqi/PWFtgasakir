<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $complaints = $query->latest()->paginate(10);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show($id)
    {
        $complaint = Complaint::with(['user', 'category', 'responses'])->findOrFail($id);
        return view('admin.complaints.show', compact('complaint'));
    }

    public function forwardToConstructor($id)
    {
        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status' => 'proses',
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Aduan berhasil diteruskan ke tim konstruksi lapangan.');
    }

    public function finalizeComplaint(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|min:5',
        ]);

        $complaint = Complaint::findOrFail($id);

        DB::table('responses')->insert([
            'complaint_id' => $complaint->id,
            'user_id'      => auth()->id(),
            'message'      => $request->response,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        DB::table('complaints')
            ->where('id', $id)
            ->update([
                'status' => 'selesai',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Laporan keluhan resmi ditutup dan dinyatakan Selesai!');
    }
}
