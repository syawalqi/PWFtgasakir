<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    #[OA\Get(
        path: '/api/categories',
        summary: 'Ambil semua kategori',
        tags: ['Categories'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Daftar kategori',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Category')),
                    ]
                )
            )
        ]
    )]
    public function index(): JsonResponse
    {
        $categories = ComplaintCategory::withCount('complaints')->get();
        return response()->json(['success' => true, 'data' => $categories]);
    }

    #[OA\Post(
        path: '/api/categories',
        summary: 'Tambah kategori baru (Admin)',
        tags: ['Categories'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', minLength: 3, maxLength: 100, example: 'Infrastruktur'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Kategori berhasil ditambahkan',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Kategori berhasil ditambahkan'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Category'),
                    ]
                )
            )
        ]
    )]
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'unique:complaint_categories'],
        ]);

        $category = ComplaintCategory::create($request->only('name'));

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category,
        ], 201);
    }

    #[OA\Put(
        path: '/api/categories/{category}',
        summary: 'Update kategori (Admin)',
        tags: ['Categories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'category', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', minLength: 3, maxLength: 100, example: 'Infrastruktur Updated'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Kategori berhasil diperbarui',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Kategori berhasil diperbarui'),
                        new OA\Property(property: 'data', ref: '#/components/schemas/Category'),
                    ]
                )
            )
        ]
    )]
    public function update(Request $request, ComplaintCategory $category): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'unique:complaint_categories,name,' . $category->id],
        ]);

        $category->update($request->only('name'));

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $category,
        ]);
    }

    #[OA\Delete(
        path: '/api/categories/{category}',
        summary: 'Hapus kategori (Admin)',
        tags: ['Categories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'category', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Kategori berhasil dihapus',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Kategori berhasil dihapus'),
                    ]
                )
            )
        ]
    )]
    public function destroy(ComplaintCategory $category): JsonResponse
    {
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}
