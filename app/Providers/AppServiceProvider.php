<?php

namespace App\Providers;

use App\Events\PostCreationEvent;
use App\Listeners\PostCreationListener;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Event;
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

        Gate::policy(Post::class, PostPolicy::class);
        
        Event::listen(
            PostCreationEvent::class,
            PostCreationListener::class,
        );        
    }
}
