@extends('layouts.app')

@section('title', 'My Cart')

@section('content')

<div class="py-6">
    <div class="container mx-auto px-4">
        
        <h2 class="text-3xl font-bold mb-6 font-poppins">Shopping Cart</h2>

        <div class="flex flex-col md:flex-row gap-6">
            
            <div class="w-full md:w-3/4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    @if($cartItems->count() > 0)
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="p-4 font-semibold text-gray-600">Product</th>
                                    <th class="p-4 font-semibold text-gray-600">Price</th>
                                    <th class="p-4 font-semibold text-gray-600">Quantity</th>
                                    <th class="p-4 font-semibold text-gray-600">Total</th>
                                    <th class="p-4 font-semibold text-gray-600">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cartItems as $item)
                                <tr class="product_data border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            @if($item->product->image)
                                                <img src="{{ asset('uploads/products/'.$item->product->image) }}" class="w-16 h-16 object-cover rounded mr-4">
                                            @endif
                                            <div>
                                                <h3 class="font-bold text-gray-800">{{ $item->product->name }}</h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-700">
                                        ${{ $item->product->discount_price ?? $item->product->price }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center border border-gray-300 rounded w-max">
                                            <input type="hidden" class="prod_id" value="{{ $item->product_id }}">
                                            <button class="px-2 py-1 bg-gray-100 decrement-btn">-</button>
                                            <input type="text" value="{{ $item->product_qty }}" class="w-10 text-center border-none qty-input" readonly>
                                            <button class="px-2 py-1 bg-gray-100 increment-btn">+</button>
                                        </div>
                                    </td>
                                    <td class="p-4 font-bold text-gray-800">
                                        ${{ ($item->product->discount_price ?? $item->product->price) * $item->product_qty }}
                                    </td>
                                    <td class="p-4">
                                        <button class="delete-cart-item bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @php $total += ($item->product->discount_price ?? $item->product->price) * $item->product_qty; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-10 text-center">
                            <h3 class="text-xl font-bold text-gray-600 mb-4">Your cart is empty</h3>
                            <a href="{{ url('/shop') }}" class="bg-blue-600 text-white px-6 py-2 rounded shadow">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-xl mb-4 border-b pb-2">Order Summary</h3>
                    <div class="flex justify-between mb-2 text-gray-600">
                        <span>Subtotal</span>
                        <span>${{ $total }}</span>
                    </div>
                    <div class="flex justify-between mb-4 text-gray-600">
                        <span>Tax</span>
                        <span>$0.00</span>
                    </div>
                    <div class="flex justify-between mb-6 text-xl font-bold text-gray-900 border-t pt-2">
                        <span>Total</span>
                        <span>${{ $total }}</span>
                    </div>
                    <a href="{{ url('checkout') }}" class="block w-full bg-orange-500 hover:bg-orange-600 text-center text-white font-bold py-3 rounded shadow transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // Delete Cart Item
        $('.delete-cart-item').click(function (e) {
            e.preventDefault();

            var prod_id = $(this).closest('.product_data').find('.prod_id').val();
            var thisClick = $(this);

            $.ajax({
                method: "POST",
                url: "/delete-cart-item",
                data: { 'product_id': prod_id },
                success: function (response) {
                    thisClick.closest('.product_data').remove();
                    toastr.success(response.status);
                    setTimeout(function(){ window.location.reload(); }, 1000);
                }
            });
        });

    });
</script>
@endsection

@endsection