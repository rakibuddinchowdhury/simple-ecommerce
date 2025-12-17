@extends('layouts.app')

@section('title', 'Add Product')

@section('content')

<div class="max-w-6xl mx-auto mt-6">
    <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-100">
        
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Add New Product</h2>
            <a href="{{ url('admin/products') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition font-medium">
                &larr; Back
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 bg-gray-50">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="e.g. Nike Air Max">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Slug</label>
                        <input type="text" name="slug" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" placeholder="nike-air-max">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"></textarea>
                    </div>

                </div>

                <div class="space-y-6">
                    
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Pricing & Stock</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Original Price ($)</label>
                            <input type="number" name="price" class="w-full border-gray-300 rounded p-2" placeholder="100.00">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Selling Price ($)</label>
                            <input type="number" name="discount_price" class="w-full border-gray-300 rounded p-2" placeholder="80.00">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                            <input type="number" name="stock_quantity" class="w-full border-gray-300 rounded p-2" placeholder="50">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">SKU Code</label>
                            <input type="text" name="sku" class="w-full border-gray-300 rounded p-2" placeholder="NIKE-001">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Status</h3>
                        
                        <div class="flex items-center mb-3">
                            <input type="checkbox" name="status" class="h-5 w-5 text-blue-600 rounded">
                            <label class="ml-2 text-sm text-gray-700">Active Status</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" class="h-5 w-5 text-yellow-500 rounded">
                            <label class="ml-2 text-sm text-gray-700">Featured Product</label>
                        </div>
                    </div>

                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                    </div>

                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="w-full md:w-auto bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                    Save Product
                </button>
            </div>

        </form>
    </div>
</div>

@endsection