<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('isSuperAdmin',function(User $user){
            return $user->role_id ===1;
        });
        Gate::define('isStoreOwner',function(User $user){
            return $user->role_id ===2;
        });
        Gate::define('isUser',function(User $user){
            return $user->role_id ===3;
        });
    }
}
