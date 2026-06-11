<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;

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
        // Validasi yang longgar dan aman agar tidak gampang melempar error saat demo
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // AUTO-DETECT KOLOM KATEGORI: Mendeteksi apakah input html bernama 'category_id' atau 'complaint_category_id'
        $categoryId = $request->category_id ?? $request->complaint_category_id;

        // Jika user lupa memilih kategori, kita berikan default kategori pertama agar database tidak crash NULL
        if (!$categoryId) {
            $firstCategory = ComplaintCategory::first();
            $categoryId = $firstCategory ? $firstCategory->id : 1;
        }

        // Menyiapkan array data kiriman
        $insertData = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending', // Kunci status awal bahasa Indonesia
        ];

        // Mencegah error Mass Assignment dengan menyuntikkan id kategori ke kedua nama kolom potensial
        $insertData['category_id'] = $categoryId;
        $insertData['complaint_category_id'] = $categoryId;

        // Proses upload gambar jika di form-nya diisi oleh user
        if ($request->hasFile('image')) {
            $insertData['image'] = $request->file('image')->store('complaints', 'public');
        }

        // Buat data aduan ke database
        Complaint::create($insertData);

        return redirect()->route('user.complaints.index')->with('success', 'Aduan berhasil dikirim!');
    }

    public function show($id)
    {
        $complaint = Complaint::with(['category', 'responses.user'])->findOrFail($id);
        return view('user.complaints.show', compact('complaint'));
    }
}