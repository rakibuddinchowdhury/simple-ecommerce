@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="max-w-7xl mx-auto mt-6">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-100">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Order Details</h2>
            <a href="{{ url('admin/orders') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">Back to List</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h4 class="text-lg font-bold text-primary mb-4">Customer Details</h4>
                <div class="space-y-3 text-sm text-gray-700">
                    <p><span class="font-bold w-32 inline-block">Order ID:</span> {{ $item->id }}</p>
                    <p><span class="font-bold w-32 inline-block">Tracking No:</span> {{ $order->tracking_no }}</p>
                    <p><span class="font-bold w-32 inline-block">Order Date:</span> {{ $order->created_at->format('d-m-Y h:i A') }}</p>
                    <p><span class="font-bold w-32 inline-block">Payment Mode:</span> {{ $order->payment_mode }}</p>
                    <hr class="border-gray-300 my-2">
                    <p><span class="font-bold w-32 inline-block">Full Name:</span> {{ $order->fullname }}</p>
                    <p><span class="font-bold w-32 inline-block">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="font-bold w-32 inline-block">Phone:</span> {{ $order->phone }}</p>
                    <p><span class="font-bold w-32 inline-block">Address:</span> {{ $order->address }}</p>
                    <p><span class="font-bold w-32 inline-block">City / Zip:</span> {{ $order->city }}, {{ $order->zipcode }}</p>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-bold text-primary mb-4">Order Items</h4>
                <div class="border border-gray-200 rounded-lg overflow-hidden mb-6">
                    <table class="w-full text-left text-sm bg-white">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="p-3 border-b">Item ID</th>
                                <th class="p-3 border-b">Image</th>
                                <th class="p-3 border-b">Product</th>
                                <th class="p-3 border-b">Qty</th>
                                <th class="p-3 border-b">Price</th>
                                <th class="p-3 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0; @endphp
                            @foreach ($order->orderItems as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $item->id }}</td>
                                <td class="p-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('uploads/products/'.$item->product->image) }}" class="w-10 h-10 object-cover rounded border">
                                    @else
                                        <span class="text-xs text-gray-400">No Img</span>
                                    @endif
                                </td>
                                <td class="p-3 font-medium">{{ $item->product->name }}</td>
                                <td class="p-3">{{ $item->qty }}</td>
                                <td class="p-3">${{ $item->price }}</td>
                                <td class="p-3 font-bold">${{ $item->qty * $item->price }}</td>
                            </tr>
                            @php $totalPrice += $item->qty * $item->price; @endphp
                            @endforeach
                            <tr class="bg-gray-50">
                                <td colspan="5" class="p-3 font-bold text-right text-gray-800 uppercase">Grand Total:</td>
                                <td class="p-3 font-bold text-primary text-lg">${{ $totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Process Order</h4>
                    <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="block text-sm font-semibold text-gray-700 mb-2">Update Status</label>
                        <div class="flex gap-4">
                            <select name="order_status" class="flex-1 border-gray-300 rounded-lg p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="0" {{ $order->status == '0' ? 'selected':'' }}>Pending</option>
                                <option value="1" {{ $order->status == '1' ? 'selected':'' }}>Completed</option>
                                <option value="2" {{ $order->status == '2' ? 'selected':'' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection