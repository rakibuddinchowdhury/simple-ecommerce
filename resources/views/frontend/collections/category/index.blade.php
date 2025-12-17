@extends('layouts.app')

@section('title', $category->name . ' - Collections')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 font-poppins">{{ $category->name }}</h2>
            <p class="text-gray-500 mt-2">Check out our latest products in {{ $category->name }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-lg border border-gray-100 overflow-hidden transition duration-300 group">
                    <a href="{{ url('collections/'.$category->slug.'/'.$product->slug) }}">
                        <div class="h-60 bg-gray-50 overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('uploads/products/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $category->name }}</p>
                        <a href="{{ url('collections/'.$category->slug.'/'.$product->slug) }}">
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
                    <div class="p-5 text-center bg-gray-100 rounded text-gray-600">
                        No Products Available in this Category yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection