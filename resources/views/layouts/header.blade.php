<header class="bg-white shadow-md sticky top-0 z-50">
    
    <div class="bg-primary text-white py-2 text-xs hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p>Free Shipping on all orders over $50!</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:underline">Track Order</a>
                <a href="#" class="hover:underline">Support</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        
        <a href="{{ url('/') }}" class="text-2xl font-bold font-poppins text-gray-800">
            MyShop<span class="text-secondary">.</span>
        </a>

        <div class="hidden md:flex flex-1 mx-10 max-w-xl relative">
            <form action="{{ url('search') }}" method="GET" class="w-full flex">
                <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Search for products..." class="w-full border border-gray-300 rounded-l-full py-2 px-4 pl-10 focus:outline-none focus:border-primary">
                <button type="submit" class="bg-primary text-white px-5 rounded-r-full hover:bg-blue-700 transition flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        <div class="flex items-center space-x-6">
            
            <a href="#" class="text-gray-600 hover:text-primary relative group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </a>

            <a href="{{ url('/cart') }}" class="text-gray-600 hover:text-primary relative group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="absolute -top-1 -right-1 bg-secondary text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                    {{ Auth::check() ? App\Models\Cart::where('user_id', Auth::id())->count() : 0 }}
                </span>
            </a>

            <div class="relative">
                <button onclick="toggleDropdown()" class="flex items-center text-gray-600 hover:text-primary focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </button>
                
                <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg hidden z-50">
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                    @else
                        <div class="px-4 py-2 text-xs text-gray-500 border-b bg-gray-50">
                            Hello, {{ Auth::user()->name }}
                        </div>

                        {{-- Admin Dashboard Link --}}
                        @if(Auth::user()->role == '1')
                            <a href="{{ url('admin/dashboard') }}" class="block px-4 py-2 text-sm text-blue-600 font-semibold hover:bg-gray-100 border-b">Admin Panel</a>
                        @endif

                        {{-- User Links --}}
                        <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                        <a href="{{ url('/my-orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                        <a href="{{ url('/change-password') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b">Change Password</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>

    <nav class="hidden md:block bg-gray-50 border-t border-b border-gray-200">
        <div class="container mx-auto px-4">
            <ul class="flex space-x-8 py-3 text-sm font-medium text-gray-700">
                <li><a href="{{ url('/') }}" class="hover:text-primary transition">Home</a></li>
                <li><a href="{{ url('/shop') }}" class="hover:text-primary transition">All Products</a></li>
                
                @php
                    $navCategories = App\Models\Category::where('status', '1')->take(5)->get();
                @endphp
                
                @foreach($navCategories as $cat)
                    <li><a href="{{ url('collections/'.$cat->slug) }}" class="hover:text-primary transition">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-inner">
        <a href="{{ url('/') }}" class="block px-4 py-3 text-sm text-gray-700 border-b hover:bg-gray-50">Home</a>
        <a href="{{ url('/shop') }}" class="block px-4 py-3 text-sm text-gray-700 border-b hover:bg-gray-50">Shop</a>
        
        @guest
            <a href="{{ route('login') }}" class="block px-4 py-3 text-sm text-gray-700 border-b hover:bg-gray-50">Login</a>
            <a href="{{ route('register') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">Register</a>
        @else
            @if(Auth::user()->role == '1')
                <a href="{{ url('admin/dashboard') }}" class="block px-4 py-3 text-sm text-blue-600 border-b hover:bg-gray-50">Admin Dashboard</a>
            @endif
            <a href="{{ url('/profile') }}" class="block px-4 py-3 text-sm text-gray-700 border-b hover:bg-gray-50">My Profile</a>
            <a href="{{ url('/my-orders') }}" class="block px-4 py-3 text-sm text-gray-700 border-b hover:bg-gray-50">My Orders</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-gray-50">Logout</button>
            </form>
        @endguest
    </div>

</header>

<script>
    // Toggle Mobile Menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Toggle User Dropdown (Click Based)
    function toggleDropdown() {
        var dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    window.onclick = function(event) {
        if (!event.target.closest('.relative')) {
            var dropdowns = document.getElementsByClassName("hidden");
            var dropdown = document.getElementById('user-dropdown');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    }
</script>