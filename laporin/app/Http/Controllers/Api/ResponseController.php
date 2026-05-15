<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index(Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }

        $responses = $complaint->responses()->with('user')->latest()->get();

        return response()->json(['success' => true, 'data' => $responses]);
    }

    public function store(Request $request, Complaint $complaint): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'min:10'],
        ]);

        $response = $complaint->responses()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil ditambahkan',
            'data' => $response,
        ], 201);
    }
}
