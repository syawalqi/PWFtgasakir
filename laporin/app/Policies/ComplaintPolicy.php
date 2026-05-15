<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;

class ComplaintPolicy
{
    public function view(User $user, Complaint $complaint): bool
    {
        return $user->id === $complaint->user_id || $user->role === 'admin';
    }

    public function update(User $user, Complaint $complaint): bool
    {
        return $user->id === $complaint->user_id && $complaint->status === 'pending';
    }

    public function delete(User $user, Complaint $complaint): bool
    {
        return $user->id === $complaint->user_id && $complaint->status === 'pending';
    }
}
