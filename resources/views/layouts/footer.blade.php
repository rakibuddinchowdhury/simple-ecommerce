<footer class="bg-neutral-black text-white pt-12 pb-6 mt-auto">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            
            <div>
                <h3 class="text-xl font-bold font-poppins mb-4">MyShop.</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    The best place to buy modern electronics and fashion. 
                    Quality products, fast shipping, and 24/7 support.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook"></i> FB</a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i> TW</a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i> IG</a>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ url('/shop') }}" class="hover:text-white transition">Shop Now</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-white transition">About Us</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-white transition">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Categories</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Electronics</a></li>
                    <li><a href="#" class="hover:text-white transition">Fashion</a></li>
                    <li><a href="#" class="hover:text-white transition">Home & Garden</a></li>
                    <li><a href="#" class="hover:text-white transition">Sports</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Contact</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-start">
                        <span class="mr-2">📍</span> 123 Street Name, City, Country
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">📞</span> +1 234 567 890
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">✉️</span> support@myshop.com
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} MyShop. All rights reserved.</p>
            <div class="mt-4 md:mt-0">
                <img src="https://via.placeholder.com/250x30/374151/FFFFFF?text=Visa+Mastercard+Paypal" alt="Payments" class="opacity-70">
            </div>
        </div>

    </div>
</footer>