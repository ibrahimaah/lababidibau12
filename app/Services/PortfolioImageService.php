<?php 
namespace App\Services;

use App\Models\Category;

class PortfolioImageService
{
    public function getCategoryById($category_id)
    {
        return Category::findOrFail($category_id);
    }

    public function getAllCategories()
    {
        return Category::all() ?? null;
    }

    // public function getImagesByCategoryId($category_id)
    // {
    //     $category = $this->getCategoryById($category_id);
    //     return $category->images() ?? null ;
    // }
}