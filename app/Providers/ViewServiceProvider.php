<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Category;
use App\Models\HeroImage;
use App\Models\Service;
use App\Models\Slider;
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
            $view->with('social_media', SocialMediaLink::all())->with('categories', Category::all());
        });

        // View::composer('partials._header', HeaderComposer::class);
        Facades\View::composer('partials.main-page._slider', function (View $view) {
            $view->with('sliders', Slider::with('media')->get());
        });

        // Get the hero image from database
        $heroImage = HeroImage::first();
        // Check if hero image exists and has media
        $heroMedia = $heroImage ? $heroImage->getFirstMedia('hero') : null;
        // Check if hero is enabled using your helper function
        $heroEnabled = setting('hero_enabled', 'true') === 'true';

        Facades\View::composer('partials.main-page._hero_img', function (View $view) use ($heroMedia, $heroEnabled) {
            $view->with('heroMedia', $heroMedia)->with('heroEnabled', $heroEnabled);
        });


        Facades\View::composer('partials.main-page._about', function (View $view) {
            $view->with('about_us', About::first())->with('services', Service::all());
        });
    }
}
