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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    <style>
        @keyframes zoomIn {
            0% { 
                transform: scale(0.1); 
                opacity: 0; 
            }
            60% { 
                transform: scale(1.05); 
                opacity: 1; 
            }
            100% { 
                transform: scale(1); 
                opacity: 1; 
            }
        }

        @keyframes zoomOut {
            0% { 
                transform: scale(1); 
                opacity: 1; 
            }
            40% { 
                transform: scale(1.05); 
                opacity: 1; 
            }
            100% { 
                transform: scale(0.1); 
                opacity: 0; 
            }
        }

        .animate-zoomIn {
            animation: zoomIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .animate-zoomOut {
            animation: zoomOut 0.4s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            scroll-behavior: smooth;
        }
    </style>
    
</head>
<body class="bg-gray-50 dark:bg-gray-900 dark:text-gray-100">
    @include('components.alert')
    @include('partials.header')
    <x-confirm-delete />
    <div class="flex pt-20 h-screen overflow-hidden"> 
        @include('partials.sidebar')
        <main class="flex-1 overflow-y-auto p-6">
            <x-breadcrumb />
            
            @yield('content')
            
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