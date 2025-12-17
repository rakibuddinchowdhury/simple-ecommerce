@extends('layouts.app')

@section('title', 'Add Category')

@section('content')

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Add New Category</h2>
            <a href="{{ url('admin/category') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border" placeholder="Electronics">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug (URL)</label>
                    <input type="text" name="slug" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border" placeholder="electronics-devices">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="status" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">
                        Visible Status (Checked = Visible)
                    </label>
                </div>

            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded shadow transition">
                    Save Category
                </button>
            </div>

        </form>
    </div>
</div>

@endsection