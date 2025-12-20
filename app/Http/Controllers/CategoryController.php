<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Enums\PageFeatureEnum;
use App\Http\Requests\StoreCategoryRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        
        return view('admin.home.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
       
        try 
        {
            $validated = $request->validated();
            // Create the category
            $category = Category::create($validated);

            // Handle icon upload using Spatie Media Library
            if ($request->hasFile('icon')) {
                $category->addMediaFromRequest('icon')
                    ->withResponsiveImages()
                    ->toMediaCollection('icons');
            }
 

            return redirect()->route('admin-category')
                ->with('success', 'Category created successfully!');
                
        } catch (Exception $e) {
            Log::error('Category creation failed', [
                'error' => $e->getMessage(),
                'data' => $request->except('icon')
            ]);
            
            return back()
                ->with('faild', 'Failed to create category: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        return view('admin.home.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'remove_icon' => 'nullable|boolean',
        ]);

        try {
            // Update category details
            $category->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);

            // Handle icon removal
            if ($request->has('remove_icon') && $request->remove_icon == 1) {
                $category->clearMediaCollection('icons');
                Log::info('Icon removed from category', [
                    'category_id' => $category->id, 
                ]);
            }

            // Handle new icon upload
            if ($request->hasFile('icon')) {
                // Remove old icon first
                $category->clearMediaCollection('icons');
                
                // Add new icon
                $category->addMediaFromRequest('icon')
                    ->withResponsiveImages()
                    ->toMediaCollection('icons');
                
            }
 

            return redirect()->route('edit-category', $category->id)
                ->with('success', 'Category updated successfully!');
                
        } catch (\Exception $e) {
            Log::error('Category update failed', [
                'category_id' => $id,
                'error' => $e->getMessage(),
                'data' => $request->except('icon')
            ]);
            
            return back()
                ->with('faild', 'Failed to update category: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        try {
            // Get category name for logging before deletion
            $categoryName = $category->name;
            
            // Delete category (Spatie Media Library will automatically delete associated media)
            $category->delete();
            
            // Log the deletion
            Log::info('Category deleted', [
                'id' => $id,
                'name' => $categoryName, 
            ]);
            
            return redirect()->route('admin-category')
                ->with('success-removed', 'Category deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Category deletion failed', [
                'category_id' => $id,
                'error' => $e->getMessage(),
            ]);
            
            return redirect()->route('admin-category')
                ->with('faild-removed', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    /**
     * Toggle categories section visibility.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleCategories(Request $request)
    {
        try {
            $enabled = $request->boolean('categories_status');
    
            PageFeatureEnum::HOME_CATEGORIES->set($enabled);
            
            return back()->with(
                'categories_toggle_status',
                $enabled ? 'enabled' : 'disabled'
            );
                
        } catch (Exception $e) {
            Log::error('Failed to toggle categories section', [
                'error' => $e->getMessage(),
            ]);
            
            return redirect()->route('admin-category')
                ->with('faild', 'Failed to toggle categories section: ' . $e->getMessage());
        }
    }

    /**
     * Get category statistics for dashboard.
     *
     * @return array
     */
    public function getStatistics()
    {
        return [
            'total_categories' => Category::count(),
            'active_categories' => Category::where('status', 'active')->count(),
            // 'recent_categories' => Category::where('created_at', '>=', now()->subDays(7))->count(),
            'categories_without_icons' => Category::whereDoesntHave('media', function($query) {
                $query->where('collection_name', 'icons');
            })->count(),
        ];
    }

    
}