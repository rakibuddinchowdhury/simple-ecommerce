@extends('layouts.app')

@section('title', 'Category List')

@section('content')

<div class="max-w-6xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Categories</h2>
            <a href="{{ url('admin/category/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                + Add Category
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Image</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Name</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 border-b text-gray-700">{{ $item->id }}</td>
                        <td class="py-3 px-4 border-b">
                            @if($item->image)
                                <img src="{{ asset('uploads/category/'.$item->image) }}" class="w-12 h-12 object-cover rounded" alt="Img">
                            @else
                                <span class="text-gray-400 text-xs">No Img</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b text-gray-700 font-medium">{{ $item->name }}</td>
                        <td class="py-3 px-4 border-b">
                            @if($item->status == '1')
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">Visible</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded">Hidden</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b flex space-x-2">
                            <a href="{{ url('admin/category/'.$item->id.'/edit') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-2 rounded">
                                Edit
                            </a>
                            <form action="{{ url('admin/category/'.$item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection