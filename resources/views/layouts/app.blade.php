<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Modern eCommerce')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E40AF',   // Royal Blue
                        secondary: '#F97316', // Orange
                        accent: '#22C55E',    // Green
                        neutral: {
                            white: '#FFFFFF',
                            light: '#F3F4F6',
                            dark: '#374151',
                            black: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], // Headings
                        body: ['Roboto', 'sans-serif'],  // Body text
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Roboto', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Toastr Customization */
        .toast-success { background-color: #22C55E !important; }
        .toast-error { background-color: #EF4444 !important; }
    </style>
</head>
<body class="bg-neutral-light text-neutral-black flex flex-col min-h-screen">

    @include('layouts.header')

    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    @yield('scripts')
</body>
</html>