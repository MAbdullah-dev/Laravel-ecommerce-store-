<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
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
        Gate::define('view-order', function (User $user, $orderId) {
            $store=Store::where('user_id',$user->id)->firstOrFail();
            return Order::where('id', $orderId)->where('store_id', $store->id)->exists();
        });
        Gate::define('manage-product', function (User $user, Product $product) {
            // Find the store associated with the user
            $store = Store::where('user_id', $user->id)->first();

            // Check if the product belongs to the user's store
            return $store && $product->store_id === $store->id;
        });


    }
}
