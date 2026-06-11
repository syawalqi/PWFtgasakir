<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Constructor\ConstructorDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'constructor') {
            return redirect()->route('constructor.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // AREA ROLE: USER / MASYARAKAT
    // ==========================================
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('complaints', ComplaintController::class);
    });

    // ==========================================
    // AREA ROLE: ADMIN / PETUGAS PUSAT
    // ==========================================
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::post('complaints/{id}/forward', [AdminComplaintController::class, 'forwardToConstructor'])->name('complaints.forward');
        Route::post('complaints/{id}/finalize', [AdminComplaintController::class, 'finalizeComplaint'])->name('complaints.finalize');
        
        Route::resource('complaints', AdminComplaintController::class)->only(['index', 'show']);
        Route::resource('categories', CategoryController::class);
        Route::post('complaints/{complaint}/responses', [ResponseController::class, 'store'])->name('responses.store');
    });

    // ==========================================
    // AREA ROLE: KONSTRUKTOR (ALUR KERJA LAPANGAN)
    // ==========================================
    Route::prefix('constructor')->name('constructor.')->middleware('role:constructor')->group(function () {
        Route::get('/dashboard', [ConstructorDashboardController::class, 'index'])->name('dashboard');
        Route::post('/complaints/{id}/complete', [ConstructorDashboardController::class, 'updateStatus'])->name('complaints.complete');
        Route::post('/complaints/{id}/update', [ConstructorDashboardController::class, 'updateStatus'])->name('complaints.update');
    });
    
});

require __DIR__.'/auth.php';