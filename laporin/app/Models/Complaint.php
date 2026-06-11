<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    use HasFactory;

    // FIX: Mempertahankan field 'image' asli milikmu agar upload foto aduan tidak error
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'status', 'image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // FIX: Mempertahankan nama model kategori asli kelompokmu yaitu 'ComplaintCategory'
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * ACCESSOR FIX: Menambahkan warna badge Tailwind otomatis untuk 
     * alur status baru yang melibatkan Konstruktor.
     */
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'                  => 'bg-yellow-100 text-yellow-800',
            'assigned_to_constructor'  => 'bg-amber-100 text-amber-800 border border-amber-200 animate-pulse', // Emas/Oranye (Sedang Diperbaiki Konstruktor)
            'constructor_finished'     => 'bg-blue-100 text-blue-800 font-bold', // Biru (Konstruktor Selesai, Butuh Validasi)
            'selesai'                  => 'bg-green-100 text-green-800', // Hijau (Selesai Total oleh Admin)
            'diproses'                 => 'bg-blue-100 text-blue-800', // (Opsi cadangan alur lama)
            default                    => 'bg-gray-100 text-gray-800',
        };
    }
} 