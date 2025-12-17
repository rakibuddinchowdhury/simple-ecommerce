@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h2 class="text-2xl font-bold mb-6 font-poppins text-gray-800">My Orders</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
                            <th class="p-4 border-b">Tracking No</th>
                            <th class="p-4 border-b">Date</th>
                            <th class="p-4 border-b">Total Price</th>
                            <th class="p-4 border-b">Status</th>
                            <th class="p-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $item->tracking_no }}</td>
                            <td class="p-4 text-gray-600">{{ $item->created_at->format('d-m-Y') }}</td>
                            <td class="p-4 font-bold text-gray-800">${{ $item->total_price }}</td>
                            <td class="p-4">
                                @if($item->status == '0')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                                @elseif($item->status == '1')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Cancelled</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <a href="{{ url('my-orders/'.$item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm shadow">
                                    View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                No orders found. <a href="{{ url('/shop') }}" class="text-blue-600 underline">Start Shopping</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection