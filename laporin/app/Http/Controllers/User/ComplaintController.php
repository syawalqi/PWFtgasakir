<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.complaints.index', compact('complaints'));
    }

    public function create()
    {
        $categories = ComplaintCategory::all();
        return view('user.complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:complaint_categories,id',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => 'pending',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        Complaint::create($data);

        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil dikirim!');
    }

    public function show($id)
    {
        $complaint = Complaint::with(['category', 'responses.user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.complaints.show', compact('complaint'));
    }

    public function edit($id)
    {
        $complaint = Complaint::where('user_id', auth()->id())->findOrFail($id);
        $categories = ComplaintCategory::all();
        return view('user.complaints.edit', compact('complaint', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $complaint = Complaint::where('user_id', auth()->id())->findOrFail($id);

        if (!$complaint->isPending()) {
            return redirect()->route('user.complaints.index')
                ->with('error', 'Hanya aduan dengan status pending yang dapat diedit.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:complaint_categories,id',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($complaint->image) {
                Storage::disk('public')->delete($complaint->image);
            }
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        $complaint->update($data);

        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $complaint = Complaint::where('user_id', auth()->id())->findOrFail($id);

        if (!$complaint->isPending()) {
            return redirect()->route('user.complaints.index')
                ->with('error', 'Hanya aduan dengan status pending yang dapat dihapus.');
        }

        if ($complaint->image) {
            Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();

        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil dihapus!');
    }
}
