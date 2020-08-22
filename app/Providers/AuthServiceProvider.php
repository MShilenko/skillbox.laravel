<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\Policies\PostPolicy;
use Illuminate\Contracts\Auth\Access\Gate as AuthGate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(AuthGate $gate)
    {
        $this->registerPolicies();

        /** Метод позволяет определить правила до объявления политик. Здесь разрешен полный доступ для админа */
        $gate->before(function($user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
