@extends('layouts.app')

@section('title', $product->name)

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ url('/') }}" class="text-gray-500 hover:text-blue-600">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="{{ url('collections/'.$category->slug) }}" class="text-gray-500 hover:text-blue-600">{{ $category->name }}</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li class="text-gray-700 font-medium truncate">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="product_data grid grid-cols-1 md:grid-cols-2 gap-10">
            
            <input type="hidden" value="{{ $product->id }}" class="prod_id">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" class="max-h-96 object-contain">
                @else
                    <img src="https://via.placeholder.com/400x400" alt="No Image" class="max-h-96">
                @endif
            </div>

            <div>
                <h1 class="text-3xl font-bold text-gray-900 font-poppins mb-2">{{ $product->name }}</h1>
                <p class="text-sm text-gray-500 mb-4">SKU: {{ $product->sku ?? 'N/A' }}</p>

                <div class="mb-6">
                    @if($product->discount_price)
                        <span class="text-3xl font-bold text-gray-900">${{ $product->discount_price }}</span>
                        <span class="text-xl text-gray-400 line-through ml-2">${{ $product->price }}</span>
                        <span class="ml-2 bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded">
                            Save ${{ $product->price - $product->discount_price }}
                        </span>
                    @else
                        <span class="text-3xl font-bold text-gray-900">${{ $product->price }}</span>
                    @endif
                </div>

                <div class="mb-6">
                    @if($product->stock_quantity > 0)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">In Stock</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">Out of Stock</span>
                    @endif
                </div>

                <p class="text-gray-600 mb-8 leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="flex items-center space-x-4 mb-6">
                    
                    <div class="flex items-center border border-gray-300 rounded">
                        <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 decrement-btn">-</button>
                        <input type="text" value="1" class="w-12 text-center border-none focus:ring-0 qty-input" readonly>
                        <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 increment-btn">+</button>
                    </div>

                    <button type="button" class="addToCartBtn flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-lg transition transform hover:-translate-y-0.5">
                        Add to Cart
                    </button>

                    <button type="button" class="p-3 border border-gray-300 rounded hover:bg-gray-50 text-gray-500 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {

        // 1. Quantity Increment
        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var inc_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });

        // 2. Quantity Decrement
        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var dec_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });

        // 3. Add to Cart AJAX
        $('.addToCartBtn').click(function (e) {
            e.preventDefault();

            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty-input').val();

            // Set CSRF Token for security
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                },
                success: function (response) {
                    toastr.success(response.status);
                },
                error: function (xhr) {
                    // If user is not logged in, redirect or show error
                    if(xhr.status == 401) {
                         window.location.href = "{{ route('login') }}";
                    } else {
                         toastr.error('Something went wrong. Please try again.');
                    }
                }
            });
        });

    });
</script>
@endsection

@endsection