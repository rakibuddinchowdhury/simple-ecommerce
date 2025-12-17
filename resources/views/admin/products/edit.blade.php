@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="max-w-6xl mx-auto mt-6">
    <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-100">
        
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
            <a href="{{ url('admin/products') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium">Back</a>
        </div>

        <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg p-3 bg-gray-50">
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}" {{ $cate->id == $product->category_id ? 'selected':'' }}>
                                    {{ $cate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded-lg p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug" value="{{ $product->slug }}" class="w-full border-gray-300 rounded-lg p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg p-3">{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Pricing</h3>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-700">Price ($)</label>
                            <input type="number" name="price" value="{{ $product->price }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-700">Selling Price ($)</label>
                            <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div>
                             <label class="text-sm font-medium text-gray-700">SKU</label>
                             <input type="text" name="sku" value="{{ $product->sku }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div class="flex items-center mb-3">
                            <input type="checkbox" name="status" {{ $product->status == 'active' ? 'checked':'' }} class="h-5 w-5 text-blue-600 rounded">
                            <label class="ml-2 text-sm text-gray-700">Active</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" {{ $product->is_featured == true ? 'checked':'' }} class="h-5 w-5 text-yellow-500 rounded">
                            <label class="ml-2 text-sm text-gray-700">Featured</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current Image</label>
                        @if($product->image)
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="w-24 h-24 object-cover rounded mb-2 border">
                        @endif
                        <input type="file" name="image" class="w-full text-sm text-gray-500">
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection