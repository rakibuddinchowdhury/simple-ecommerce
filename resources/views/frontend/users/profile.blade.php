@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="py-10">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                
                <div class="bg-white shadow-lg rounded-lg border border-gray-100 p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 font-poppins border-b pb-4">My Profile</h2>

                    <form action="{{ url('profile') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input type="text" name="username" value="{{ Auth::user()->name }}" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border focus:ring-blue-500 focus:border-blue-500">
                            @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                            <input type="text" readonly value="{{ Auth::user()->email }}" class="w-full bg-gray-100 border-gray-300 rounded-lg p-3 shadow-sm border text-gray-500 cursor-not-allowed">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Full Address</label>
                            <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">{{ Auth::user()->address }}</textarea>
                            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow transition">
                            Save Changes
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection