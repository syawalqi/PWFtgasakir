<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'status', 'image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'  => 'bg-yellow-100 text-yellow-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai'  => 'bg-green-100 text-green-800',
            default    => 'bg-gray-100 text-gray-800',
        };
    }
}
