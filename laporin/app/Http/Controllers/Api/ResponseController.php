<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ResponseController extends Controller
{
    #[OA\Get(
        path: '/api/complaints/{complaint}/responses',
        summary: 'Ambil tanggapan aduan',
        tags: ['Responses'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Daftar tanggapan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Response')),
                    ]
                )
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: false),
                        new OA\Property(property: 'message', type: 'string', example: 'Forbidden.'),
                    ]
                )
            )
        ]
    )]
    public function index(Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }

        $responses = $complaint->responses()->with('user')->latest()->get();

        return response()->json(['success' => true, 'data' => $responses]);
    }

    #[OA\Post(
        path: '/api/complaints/{complaint}/responses',
        summary: 'Tambah tanggapan aduan (Admin)',
        tags: ['Responses'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['message'],
                properties: [
                    new OA\Property(property: 'message', type: 'string', minLength: 10, example: 'Aduan Anda sedang kami proses.'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Tanggapan berhasil ditambahkan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Tanggapan berhasil ditambahkan'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Response'),
                    ]
                )
            )
        ]
    )]
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
