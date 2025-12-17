@extends('layouts.app')

@section('title', 'Home - Modern eCommerce')

@section('content')

<div class="relative bg-blue-900 text-white rounded-2xl overflow-hidden shadow-2xl mb-12">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-600 opacity-90"></div>
    <div class="relative container mx-auto px-6 py-20 md:py-32 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-10 md:mb-0">
            <h1 class="text-4xl md:text-6xl font-bold font-poppins leading-tight mb-4">
                Discover the Latest <br> <span class="text-orange-400">Tech & Trends</span>
            </h1>
            <p class="text-lg text-gray-200 mb-8 max-w-lg">
                Shop the best products at unbeatable prices. Fast shipping, secure payment, and premium support.
            </p>
            <a href="{{ url('/shop') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
                Shop Now
            </a>
        </div>
        <div class="md:w-1/2 flex justify-center">
            <img src="https://via.placeholder.com/500x300/transparent/FFFFFF?text=Modern+Devices" alt="Hero Device" class="drop-shadow-2xl animate-pulse">
        </div>
    </div>
</div>

<div class="mb-16">
    <div class="flex justify-between items-end mb-6">
        <h2 class="text-2xl font-bold text-gray-800 font-poppins border-l-4 border-blue-600 pl-3">Top Categories</h2>
        <a href="{{ url('/categories') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View All &rarr;</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @foreach ($categories as $cat)
        <a href="{{ url('collections/'.$cat->slug) }}" class="group block bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 p-4 text-center transition">
            <div class="h-24 w-24 mx-auto mb-3 overflow-hidden rounded-full bg-gray-50 flex items-center justify-center">
                @if($cat->image)
                    <img src="{{ asset('uploads/category/'.$cat->image) }}" class="object-cover w-full h-full group-hover:scale-110 transition duration-300">
                @else
                    <span class="text-gray-400 text-xs">No Image</span>
                @endif
            </div>
            <h3 class="font-semibold text-gray-700 group-hover:text-blue-600 transition">{{ $cat->name }}</h3>
        </a>
        @endforeach
    </div>
</div>

<div class="mb-16">
    <h2 class="text-2xl font-bold text-gray-800 font-poppins border-l-4 border-orange-500 pl-3 mb-6">Featured Products</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($featuredProducts as $product)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg border border-gray-100 overflow-hidden transition duration-300 group">
                <div class="relative h-60 bg-gray-50 overflow-hidden">
                    <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</span>
                    <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </a>
                    <div class="absolute bottom-0 w-full bg-white/90 py-2 translate-y-full group-hover:translate-y-0 transition duration-300 flex justify-center">
                        <button class="text-blue-700 font-bold text-sm uppercase">Add to Cart</button>
                    </div>
                </div>

                <div class="p-5">
                    <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>
                    <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                        <h3 class="font-bold text-gray-800 mb-2 truncate group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                    </a>
                    <div class="flex items-center justify-between">
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
            </div>
        @endforeach
    </div>
</div>

<div class="bg-gray-900 rounded-2xl p-8 md:p-12 text-center text-white mb-10">
    <h2 class="text-3xl font-bold mb-4 font-poppins">Join Our Newsletter</h2>
    <p class="text-gray-400 mb-8 max-w-xl mx-auto">Subscribe to get information about products and coupons.</p>
    <div class="flex justify-center max-w-md mx-auto">
        <input type="email" placeholder="Your email address" class="w-full px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none">
        <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-r-lg font-bold transition">Subscribe</button>
    </div>
</div>

@endsection