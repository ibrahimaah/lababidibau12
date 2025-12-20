<?php 

namespace App\View\Composers;

use App\Models\Category;
use App\Models\SocialMediaLink;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'social_media' => SocialMediaLink::all(),
            'categories'   => Category::all(),
        ]);
    }
}
