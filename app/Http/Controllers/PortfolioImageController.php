<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Contact;
use App\Models\Category;
use App\Models\SocialMediaLink;
use App\Services\PortfolioImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioImageController extends Controller
{
    private $portfolioImageService;

    public function __construct(PortfolioImageService $portfolioImageService)
    {
        $this->portfolioImageService = $portfolioImageService;
    }

    public function index()
    {
        $categories = $this->portfolioImageService->getAllCategories();
        $contacts = Contact::find(1);
        $social = SocialMediaLink::find(1);
        if($categories && count($categories) > 0)
        {
            return view('portfolio-image')->withCategories($categories)->withContacts($contacts)->withSocial($social);
        }
        else
        {
            return view('portfolio-image')->with('noData','There are no images yet');
        }
    }

    public function getCategoryById($category_id)
    {
        $categories = $this->portfolioImageService->getAllCategories();

        $current_category = $categories->where('id', $category_id)->first();

        $images = $current_category->images()->paginate(6);
        

        return view('portfolio-image-category')
                ->with('current_category', $current_category)
                ->with('categories', $categories)
                ->with('images', $images);
    }

   
}
