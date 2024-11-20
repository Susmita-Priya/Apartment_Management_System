<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Dynamically check permissions using the name passed to the @can directive
        Gate::before(function (User $user, $ability) {
            return $user->role && $user->role->permissions()->where('name', $ability)->exists();
        });
    }
}
