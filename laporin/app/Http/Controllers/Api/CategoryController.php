<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = ComplaintCategory::withCount('complaints')->get();
        return response()->json(['success' => true, 'data' => $categories]);
    }

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

    public function destroy(ComplaintCategory $category): JsonResponse
    {
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}
