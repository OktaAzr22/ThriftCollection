<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (() => {
            const html = document.documentElement;

            if (localStorage.theme === 'dark') {
                html.classList.add("dark");
            } else if (localStorage.theme === 'light') {
                html.classList.remove("dark");
            } else {
                html.classList.remove("dark");
            }
        })();
    </script>
    <title>@yield('title', 'Thriftting - Dashboard')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .transition-max-height {
            transition: max-height 0.3s ease-in-out;
        }
        .rotate-180 {
            transform: rotate(180deg);
        }
        .transition-rotate {
            transition: transform 0.3s ease;
        }
    </style>
    
</head>
<body class="bg-red-50">

    @include('components.alert')

    <x-confirm-delete />

    <div class="flex h-screen">

        @include('partials.sidebar')

        <main class="flex-1 overflow-y-auto">

            @include('partials.header')

            <div class="p-5">

                <x-breadcrumb />

                @yield('content')
   
            </div>
        </main>
    </div>

    @stack('scripts')

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
        }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/search-helper.js') }}"></script>
</body>
</html>