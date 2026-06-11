<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;

class ComplaintController extends Controller
{
    #[OA\Get(
        path: '/api/complaints',
        summary: 'Ambil daftar aduan user',
        tags: ['Complaints'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'per_page', in: 'query', schema: new OA\Schema(type: 'integer'), example: 10),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Daftar aduan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $complaints = Complaint::with(['user', 'category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate($request->per_page ?? 10);

        return response()->json(['success' => true, 'data' => $complaints]);
    }

    #[OA\Post(
        path: '/api/complaints',
        summary: 'Buat aduan baru',
        tags: ['Complaints'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['title', 'category_id', 'description'],
                    properties: [
                        new OA\Property(property: 'title', type: 'string', minLength: 5, maxLength: 255, example: 'Jalan rusak di desa'),
                        new OA\Property(property: 'category_id', type: 'integer', example: 1),
                        new OA\Property(property: 'description', type: 'string', minLength: 20, example: 'Jalan di desa kami sudah rusak sejak bulan lalu'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Aduan berhasil dibuat',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Aduan berhasil dibuat'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Complaint'),
                    ]
                )
            )
        ]
    )]
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

    #[OA\Get(
        path: '/api/complaints/{complaint}',
        summary: 'Lihat detail aduan',
        tags: ['Complaints'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Detail aduan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Complaint'),
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
    public function show(Complaint $complaint): JsonResponse
    {
        if ($complaint->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Forbidden.'], 403);
        }
        $complaint->load('category', 'responses.user');
        return response()->json(['success' => true, 'data' => $complaint]);
    }

    #[OA\Post(
        path: '/api/complaints/{complaint}',
        summary: 'Update aduan',
        tags: ['Complaints'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['title', 'category_id', 'description'],
                    properties: [
                        new OA\Property(property: 'title', type: 'string', minLength: 5, maxLength: 255),
                        new OA\Property(property: 'category_id', type: 'integer'),
                        new OA\Property(property: 'description', type: 'string', minLength: 20),
                        new OA\Property(property: 'image', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Aduan berhasil diperbarui',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Aduan berhasil diperbarui'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Complaint'),
                    ]
                )
            )
        ]
    )]
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

    #[OA\Delete(
        path: '/api/complaints/{complaint}',
        summary: 'Hapus aduan',
        tags: ['Complaints'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Aduan berhasil dihapus',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Aduan berhasil dihapus'),
                    ]
                )
            )
        ]
    )]
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

    #[OA\Get(
        path: '/api/admin/complaints',
        summary: 'Ambil semua aduan (Admin)',
        tags: ['Admin'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'status', in: 'query', schema: new OA\Schema(type: 'string', enum: ['pending', 'diproses', 'selesai'])),
            new OA\Parameter(name: 'search', in: 'query', schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'category_id', in: 'query', schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', schema: new OA\Schema(type: 'integer'), example: 10),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Daftar semua aduan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            )
        ]
    )]
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

    #[OA\Patch(
        path: '/api/admin/complaints/{complaint}/status',
        summary: 'Update status aduan (Admin)',
        tags: ['Admin'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'complaint', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['status'],
                properties: [
                    new OA\Property(property: 'status', type: 'string', enum: ['pending', 'diproses', 'selesai'], example: 'diproses'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Status aduan berhasil diperbarui',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Status aduan berhasil diperbarui'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Complaint'),
                    ]
                )
            )
        ]
    )]
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
