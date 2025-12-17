<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->sku = $request->sku;
        $product->description = $request->description;
        
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->stock_quantity = $request->stock_quantity;

        $product->status = $request->status == true ? 'active' : 'inactive';
        $product->is_featured = $request->is_featured == true ? '1' : '0';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/products/', $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect('admin/products')->with('success', 'Product Added Successfully!');
    }
    // Show Edit Form
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    // Update Product
    public function update(Request $request, int $product_id)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($product_id);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->sku = $request->sku;
        $product->description = $request->description;
        
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->stock_quantity = $request->stock_quantity;

        $product->status = $request->status == true ? 'active' : 'inactive';
        $product->is_featured = $request->is_featured == true ? '1' : '0';

        if ($request->hasFile('image')) {
            
            // Remove Old Image
            $path = 'uploads/products/' . $product->image;
            if(File::exists($path)){
                File::delete($path);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/products/', $filename);
            $product->image = $filename;
        }

        $product->update();

        return redirect('admin/products')->with('success', 'Product Updated Successfully!');
    }

    // Delete Product
    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->image){
             $path = 'uploads/products/' . $product->image;
             if(File::exists($path)){
                 File::delete($path);
             }
        }
        $product->delete();
        return redirect()->back()->with('success','Product Deleted Successfully');
    }
}