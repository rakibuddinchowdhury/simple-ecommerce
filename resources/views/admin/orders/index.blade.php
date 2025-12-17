@extends('layouts.app')

@section('title', 'Admin - Orders')

@section('content')

<div class="max-w-7xl mx-auto mt-6">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-100">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 font-poppins">Order Management</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="py-3 px-4 text-left border-b">Order Date</th>
                        <th class="py-3 px-4 text-left border-b">Tracking No</th>
                        <th class="py-3 px-4 text-left border-b">Customer</th>
                        <th class="py-3 px-4 text-left border-b">Total</th>
                        <th class="py-3 px-4 text-left border-b">Status</th>
                        <th class="py-3 px-4 text-left border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($orders as $item)
                    <tr class="hover:bg-gray-50 transition border-b border-gray-200">
                        <td class="py-3 px-4">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="py-3 px-4 font-medium">{{ $item->tracking_no }}</td>
                        <td class="py-3 px-4">{{ $item->fullname }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">${{ $item->total_price }}</td>
                        <td class="py-3 px-4">
                            @if($item->status == '0')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                            @elseif($item->status == '1')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Cancelled</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ url('admin/orders/'.$item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded shadow text-xs">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection