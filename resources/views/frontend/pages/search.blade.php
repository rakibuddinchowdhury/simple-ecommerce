@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 font-poppins">Search Results</h2>
            <p class="text-gray-500 mt-2">Showing results for: <strong>"{{ Request::get('search') }}"</strong></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($searchProducts as $product)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-lg border border-gray-100 overflow-hidden transition duration-300 group">
                    <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                        <div class="h-60 bg-gray-50 overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('uploads/products/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>
                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                            <h3 class="font-bold text-gray-800 mb-2 truncate group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                        </a>
                        <div>
                             @if($product->discount_price)
                                <span class="text-lg font-bold text-gray-900">${{ $product->discount_price }}</span>
                                <span class="text-sm text-gray-400 line-through ml-2">${{ $product->price }}</span>
                            @else
                                <span class="text-lg font-bold text-gray-900">${{ $product->price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-12">
                    <div class="p-10 text-center bg-gray-50 border border-gray-200 rounded-lg">
                        <h3 class="text-xl font-bold text-gray-600 mb-2">No Products Found</h3>
                        <p class="text-gray-500 mb-6">We couldn't find any products matching your search.</p>
                        <a href="{{ url('/shop') }}" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">Browse All Products</a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $searchProducts->appends(request()->input())->links() }}
        </div>

    </div>
</div>
@endsection