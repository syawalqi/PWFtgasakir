<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Complaint::with(['category', 'responses'])
            ->where('user_id', auth()->id());

        // Filter by status via ?tab= (from Activity Diagram: user can filter by status)
        $tab = $request->input('tab', 'all');
        if (in_array($tab, ['pending', 'diproses', 'selesai'])) {
            $query->where('status', $tab);
        }

        $complaints = $query->latest()->paginate(10)->withQueryString();

        return view('user.complaints.index', compact('complaints', 'tab'));
    }

    public function create()
    {
        $categories = ComplaintCategory::all();
        return view('user.complaints.create', compact('categories'));
    }

    public function store(StoreComplaintRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        Complaint::create($data);
        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil dibuat.');
    }

    public function show(Complaint $complaint)
    {
        $this->authorize('view', $complaint);
        $complaint->load('category', 'responses.user');
        return view('user.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        $categories = ComplaintCategory::all();
        return view('user.complaints.edit', compact('complaint', 'categories'));
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($complaint->image) {
                Storage::disk('public')->delete($complaint->image);
            }
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        $complaint->update($data);
        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
        $this->authorize('delete', $complaint);

        if ($complaint->image) {
            Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();
        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil dihapus.');
    }
}
