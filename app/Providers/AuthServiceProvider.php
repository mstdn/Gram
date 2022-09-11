<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\CategoryPolicy;
use App\Policies\MediaPolicy;
use App\Policies\PostPolicy;
use App\Policies\ReplyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-post', [PostPolicy::class, 'destroy']);
        Gate::define('delete-reply', [ReplyPolicy::class, 'destroy']);
        Gate::define('delete-category', [CategoryPolicy::class, 'destroy']);
        Gate::define('create-category', [CategoryPolicy::class, 'store']);
        Gate::define('delete-media', [MediaPolicy::class, 'destroy']);
    }
}
