<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\User\DashboardController;
// FIX: Import namespace Controller Konstruktor yang baru
use App\Http\Controllers\Constructor\ConstructorDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {
    
    // FIX LOGIKA: Menambahkan kondisi redirect otomatis jika yang login adalah role constructor
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'constructor') {
            return redirect()->route('constructor.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // ==========================================
    // AREA ROLE: USER / MASYARAKAT
    // ==========================================
    Route::prefix('user')->middleware('role:user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('complaints', ComplaintController::class);
    });

    // ==========================================
    // AREA ROLE: ADMIN / PETUGAS PUSAT
    // ==========================================
    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('complaints', AdminComplaintController::class)->only(['index', 'show']);
        Route::patch('complaints/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])->name('complaints.status');
        Route::resource('categories', CategoryController::class);
        Route::post('complaints/{complaint}/responses', [ResponseController::class, 'store'])->name('responses.store');
    });

    // ==========================================
    // FIX ADDON: AREA ROLE KONSTRUKTOR (BARU)
    // ==========================================
    Route::prefix('constructor')->middleware('role:constructor')->name('constructor.')->group(function () {
        // Halaman Utama Dashboard Konstruktor
        Route::get('/dashboard', [ConstructorDashboardController::class, 'index'])->name('dashboard');
        
        // Aksi Mengubah Status Kerja Konstruktor (Tandai Selesai Lapangan)
        Route::post('/complaints/{id}/complete', [ConstructorDashboardController::class, 'updateStatus'])->name('complaints.complete');
    });
    
});

require __DIR__.'/auth.php';