@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto mt-6">
    
    <h2 class="text-3xl font-bold text-gray-800 font-poppins mb-8">Dashboard Overview</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-lg shadow-md border-l-4 border-blue-600 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Total Orders</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalOrder }}</h3>
                <a href="{{ url('admin/orders') }}" class="text-blue-600 text-xs hover:underline mt-2 inline-block">View Orders &rarr;</a>
            </div>
            <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border-l-4 border-green-500 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Today's Orders</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $todayOrder }}</h3>
                <span class="text-gray-400 text-xs">New for today</span>
            </div>
            <div class="bg-green-100 p-3 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border-l-4 border-yellow-500 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">This Month</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $monthOrder }}</h3>
                <span class="text-gray-400 text-xs">Current Month</span>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border-l-4 border-red-500 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase">Yearly Orders</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $yearOrder }}</h3>
                <span class="text-gray-400 text-xs">Current Year</span>
            </div>
            <div class="bg-red-100 p-3 rounded-full text-red-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
            <h4 class="text-4xl font-bold text-primary mb-2">{{ $totalProducts }}</h4>
            <p class="text-gray-500 font-medium">Total Products</p>
            <a href="{{ url('admin/products') }}" class="text-sm text-blue-600 hover:underline mt-2 block">Manage Products</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
            <h4 class="text-4xl font-bold text-purple-600 mb-2">{{ $totalCategories }}</h4>
            <p class="text-gray-500 font-medium">Total Categories</p>
            <a href="{{ url('admin/category') }}" class="text-sm text-purple-600 hover:underline mt-2 block">Manage Categories</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
            <h4 class="text-4xl font-bold text-orange-500 mb-2">{{ $totalUser }}</h4>
            <p class="text-gray-500 font-medium">Registered Customers</p>
            <span class="text-sm text-gray-400 mt-2 block">Active Users</span>
        </div>

    </div>

</div>

@endsection