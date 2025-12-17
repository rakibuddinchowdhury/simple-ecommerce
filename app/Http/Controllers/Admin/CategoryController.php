<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    // 1. List all Categories
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    // 2. Show the Create Form
    public function create()
    {
        return view('admin.category.create');
    }

    // 3. Store the new Category in DB
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->status = $request->status == true ? '1' : '0';

        // Image Upload Logic
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/category')->with('success', 'Category Added Successfully!');
    }
    // ... inside CategoryController class ...

    // 4. Show the Edit Form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // 5. Update the Category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->status = $request->status == true ? '1' : '0';

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->save();
        return redirect('admin/category')->with('success', 'Category Updated Successfully!');
    }

    // 6. Delete the Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Delete image file
        if ($category->image) {
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $category->delete();
        return redirect('admin/category')->with('success', 'Category Deleted Successfully!');
    }
}