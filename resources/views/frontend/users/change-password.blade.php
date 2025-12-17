@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="py-10">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                
                <div class="bg-white shadow-lg rounded-lg border border-gray-100 p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 font-poppins border-b pb-4">Change Password</h2>

                    <form action="{{ url('change-password') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                            @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                            <input type="password" name="password" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                        </div>

                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg shadow transition">
                            Update Password
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection