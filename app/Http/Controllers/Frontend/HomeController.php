<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 1. Homepage
    public function index()
    {
        // 1. Fetch Categories (Status '1' = Visible/Active based on your seeder/migration logic)
        $categories = Category::where('status', '1')->take(6)->get();
        
        // 2. Fetch Featured/Trending Products
        // We use 'trending' column instead of 'is_featured'
        // We use status '0' for visible products (based on your migration comment: 0=visible, 1=hidden)
        $featuredProducts = Product::where('status', '0')
                                   ->where('trending', '1') 
                                   ->latest()
                                   ->take(8)
                                   ->get();

        // 3. Fetch New Arrivals
        $newArrivals = Product::where('status', '0')
                              ->latest()
                              ->take(8)
                              ->get();

        return view('frontend.index', compact('categories', 'featuredProducts', 'newArrivals'));
    }

    // 2. All Products / Shop Page
    public function shop()
    {
        $products = Product::where('status', 'active')->paginate(12);
        return view('frontend.shop', compact('products'));
    }

    // 3. View Products by Category
    public function viewCategory($category_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', '1')->first();

        if ($category) {
            $products = $category->products()->where('status', 'active')->get();
            return view('frontend.collections.category.index', compact('category', 'products'));
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }
    }

    // 4. View Single Product Details
    public function viewProduct($category_slug, $product_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', '1')->first();

        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', 'active')->first();
            
            if ($product) {
                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                return redirect()->back()->with('error', 'Product not found');
            }
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }
    }
    // 5. Search Products
    public function searchProducts(Request $request)
    {
        if($request->search){
            $searchProducts = Product::where('name', 'LIKE', '%'.$request->search.'%')
                                     ->latest()
                                     ->paginate(12);
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}