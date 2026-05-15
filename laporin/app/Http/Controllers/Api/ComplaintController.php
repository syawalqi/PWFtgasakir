<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $complaints = Complaint::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate($request->per_page ?? 10);

        return response()->json(['success' => true, 'data' => $complaints]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'category_id' => ['required', 'exists:complaint_categories,id'],
            'description' => ['required', 'string', 'min:20'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        $complaint = Complaint::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Aduan berhasil dibuat',
            'data' => $complaint,
        ], 201);
    }

    public function show(Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }
        $complaint->load('category', 'responses.user');
        return response()->json(['success' => true, 'data' => $complaint]);
    }

    public function update(Request $request, Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() || !$complaint->isPending()) {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'category_id' => ['required', 'exists:complaint_categories,id'],
            'description' => ['required', 'string', 'min:20'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
        ]);

        if ($request->hasFile('image')) {
            if ($complaint->image) {
                Storage::disk('public')->delete($complaint->image);
            }
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        $complaint->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Aduan berhasil diperbarui',
            'data' => $complaint,
        ]);
    }

    public function destroy(Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() || !$complaint->isPending()) {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }

        if ($complaint->image) {
            Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aduan berhasil dihapus',
        ]);
    }

    public function adminIndex(Request $request): JsonResponse
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

        $complaints = $query->latest()->paginate($request->per_page ?? 10);

        return response()->json(['success' => true, 'data' => $complaints]);
    }

    public function updateStatus(Request $request, Complaint $complaint): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,diproses,selesai'],
        ]);

        $complaint->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status aduan berhasil diperbarui',
            'data' => $complaint,
        ]);
    }
}
