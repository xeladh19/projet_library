<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
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

        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id; //Logique pour pouvoir mettre à jour le post l'id de l'user est strictement égal à l'user_id du post )
        });
        Gate::define('destroy-post', function (User $user, Post $post) {
            return $user->id === $post->user_id; //Logique pour pouvoir mettre à jour le post l'id de l'user est strictement égal à l'user_id du post )
        });
    }
}
