<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResponseRequest;
use App\Models\Complaint;

class ResponseController extends Controller
{
    public function store(StoreResponseRequest $request, Complaint $complaint)
    {
        $complaint->responses()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Tanggapan berhasil ditambahkan.');
    }
}
