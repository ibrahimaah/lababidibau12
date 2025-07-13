<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SocialMediaLink;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrapFive();
        // View::composer('partials._header', function ($view) {
        //     $view->with('categories', Category::all())->with('social_media_links', SocialMediaLink::all());
        // });
    }
}
