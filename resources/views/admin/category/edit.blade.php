@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Edit Category</h2>
            <a href="{{ url('admin/category') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">Back</a>
        </div>

        <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full border p-2 rounded shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="w-full border p-2 rounded shadow-sm">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                    @if($category->image)
                        <img src="{{ asset('uploads/category/'.$category->image) }}" class="w-20 h-20 object-cover rounded mb-2 border">
                    @endif
                    <input type="file" name="image" class="w-full text-sm text-gray-500">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">Visible Status</label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded shadow">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection