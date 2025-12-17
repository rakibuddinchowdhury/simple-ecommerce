@extends('layouts.app')

@section('title', 'Product List')

@section('content')

<div class="max-w-7xl mx-auto mt-6">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-100">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Products</h2>
            <a href="{{ url('admin/products/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Add Product
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="py-3 px-4 text-left border-b">ID</th>
                        <th class="py-3 px-4 text-left border-b">Category</th>
                        <th class="py-3 px-4 text-left border-b">Name</th>
                        <th class="py-3 px-4 text-left border-b">Price</th>
                        <th class="py-3 px-4 text-left border-b">Stock</th>
                        <th class="py-3 px-4 text-left border-b">Status</th>
                        <th class="py-3 px-4 text-left border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($products as $item)
                    <tr class="hover:bg-gray-50 transition border-b border-gray-200">
                        <td class="py-3 px-4">{{ $item->id }}</td>
                        <td class="py-3 px-4">{{ $item->category->name }}</td>
                        <td class="py-3 px-4 font-medium text-gray-800">{{ $item->name }}</td>
                        <td class="py-3 px-4">${{ $item->discount_price ?? $item->price }}</td>
                        <td class="py-3 px-4">
                            @if($item->stock_quantity > 0)
                                <span class="text-green-600 font-bold">{{ $item->stock_quantity }}</span>
                            @else
                                <span class="text-red-500 font-bold">Out of Stock</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="{{ $item->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} py-1 px-3 rounded-full text-xs font-bold">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 flex space-x-2">
                            <a href="{{ url('admin/products/'.$item->id.'/edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <a href="{{ url('admin/products/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure?')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection