@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            
            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="w-full md:w-2/3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h2 class="text-2xl font-bold mb-6 font-poppins text-gray-800">Billing Details</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="fullname" value="{{ Auth::user()->name }}" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                                @error('fullname') <small class="text-red-500">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                                @error('phone') <small class="text-red-500">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="text" value="{{ Auth::user()->email }}" readonly class="w-full bg-gray-100 border-gray-300 rounded-lg p-3 shadow-sm border text-gray-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">{{ Auth::user()->address }}</textarea>
                                @error('address') <small class="text-red-500">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" name="city" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                                @error('city') <small class="text-red-500">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                <input type="text" name="zipcode" class="w-full border-gray-300 rounded-lg p-3 shadow-sm border">
                                @error('zipcode') <small class="text-red-500">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-xl mb-4 border-b pb-2">Order Summary</h3>
                        
                        <div class="space-y-3 mb-6">
                            @php $total = 0; @endphp
                            @foreach ($cartItems as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <span>{{ $item->product->name }} x {{ $item->product_qty }}</span>
                                    @php 
                                        $price = $item->product->discount_price ?? $item->product->price;
                                        $total += $price * $item->product_qty;
                                    @endphp
                                    <span>${{ $price * $item->product_qty }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 flex justify-between items-center font-bold text-lg text-gray-900 mb-6">
                            <span>Grand Total</span>
                            <span>${{ $total }}</span>
                        </div>

                        <hr class="mb-4">

                        <div class="mb-4">
                            <label class="font-bold text-gray-700 block mb-2">Payment Method:</label>
                            <div class="flex gap-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="payment_mode" value="COD" checked class="w-5 h-5 text-blue-600">
                                    <span class="ml-2">Cash on Delivery</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="payment_mode" value="STRIPE" class="w-5 h-5 text-blue-600">
                                    <span class="ml-2">Credit Card (Stripe)</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 rounded-lg shadow mb-2">
                            Place Order
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection