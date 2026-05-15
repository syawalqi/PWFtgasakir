<?php

namespace App\Providers;

use App\Models\Complaint;
use App\Models\User;
use App\Policies\ComplaintPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Complaint::class, ComplaintPolicy::class);

        Gate::define('manage-categories', fn(User $user) => $user->role === 'admin');
        Gate::define('update-complaint-status', fn(User $user) => $user->role === 'admin');
        Gate::define('view-all-complaints', fn(User $user) => $user->role === 'admin');
        Gate::define('create-response', fn(User $user) => $user->role === 'admin');
        Gate::define('access-admin', fn(User $user) => $user->role === 'admin');
    }
}
