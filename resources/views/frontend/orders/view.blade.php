@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold font-poppins text-gray-800">Order View</h2>
            <div class="space-x-2">
                <a href="{{ url('my-orders/'.$order->id.'/invoice') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Download Invoice
                    </span>
                </a>
                
                <a href="{{ url('my-orders') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">Back to List</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Shipping Details</h4>
                <div class="space-y-3 text-sm text-gray-600">
                    <p><span class="font-bold w-24 inline-block">Full Name:</span> {{ $order->fullname }}</p>
                    <p><span class="font-bold w-24 inline-block">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="font-bold w-24 inline-block">Phone:</span> {{ $order->phone }}</p>
                    <p><span class="font-bold w-24 inline-block">Address:</span> {{ $order->address }}</p>
                    <p><span class="font-bold w-24 inline-block">City:</span> {{ $order->city }}</p>
                    <p><span class="font-bold w-24 inline-block">Zip Code:</span> {{ $order->zipcode }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Order Summary</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="p-2">Item</th>
                                <th class="p-2">Qty</th>
                                <th class="p-2">Price</th>
                                <th class="p-2">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                            <tr class="border-b">
                                <td class="p-2 font-medium">{{ $item->product->name }}</td>
                                <td class="p-2">{{ $item->qty }}</td>
                                <td class="p-2">${{ $item->price }}</td>
                                <td class="p-2">
                                    @if($item->product->image)
                                        <img src="{{ asset('uploads/products/'.$item->product->image) }}" class="w-10 h-10 object-cover rounded">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h4 class="text-xl font-bold text-gray-800 flex justify-between">
                        Grand Total: <span>${{ $order->total_price }}</span>
                    </h4>
                    <div class="mt-2">
                        <span class="text-gray-500 text-sm">Payment Mode: {{ $order->payment_mode }}</span>
                        <div class="mt-1">
                             @if($order->status == '0')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                            @elseif($order->status == '1')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Cancelled</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection