<?php
 
namespace App\Providers;

use App\Models\Category;
use App\Models\SocialMediaLink;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using closure based composers...
        Facades\View::composer('partials._header', function (View $view) {
            $view->with('social_media',SocialMediaLink::all())->with('categories', Category::all());
        });
 
    }
}