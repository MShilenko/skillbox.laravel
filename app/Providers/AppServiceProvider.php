<?php

namespace App\Providers;

use App\Post;
use App\Tag;
use App\User;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \View::composer('layout.sidebar', function($view) {
            $view->with(['tagsCloud' => Tag::tagsCloud()]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** Add Observer for Post model */
        Post::observe(PostObserver::class);

        Blade::directive('editPost', function ($post) {
            $user = User::find(Auth::id());
            $route = 'posts.edit';

            if ($user->isAdmin()) {
                $route = "admin.{$route}";
            }

            return "<?php echo route('{$route}', ['post' => {$post}]) ?>";
        });

        /** Add custom if directive for blade templates */
        Blade::if('admin', function () {
            if (!Auth::check()) {
                return false;
            }

            $user = User::find(Auth::id());

            return $user->isAdmin();
        });
    }
}
