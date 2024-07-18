<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Make sure to import your Product model here

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Apply 'auth' middleware to this controller
    }
    public function index()
    {
        $user = auth()->user();
    
        // Fetch products the user has already viewed or are in similar categories
        $viewedProductIds = $user->productViews()->pluck('product_views.product_id');
        $viewedCategories = $user->productViews()
                                 ->whereNotNull('product_views.category_id')
                                 ->pluck('product_views.category_id')
                                 ->unique();
    
        // Get products viewed by the user or in the same category
        $productsViewedOrInSimilarCategory = Product::withCount('views')
            ->whereIn('id', $viewedProductIds)
            ->orWhereIn('category_id', $viewedCategories)
            ->orderByDesc('views')
            ->get();
    
        // Get products not viewed by the user
        $productsNotViewed = Product::withCount('views')
            ->whereNotIn('id', $viewedProductIds)
            ->orderByDesc('views')
            ->get();
    
        // Combine both sets of products
        $productsByViews = $productsViewedOrInSimilarCategory->merge($productsNotViewed);
    
        $productsBySearches = Product::orderBy('searches', 'desc')->get();
        $productsByPurchases = Product::orderBy('purchases', 'desc')->get();
    
        return view('home.index', compact('productsByViews', 'productsBySearches', 'productsByPurchases'));
    }
    

    /**
     * Show the application dashboard with sorted products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
}
