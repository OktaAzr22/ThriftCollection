<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Guest Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-12 text-center w-full max-w-2xl">

        <!-- Label -->
        <span class="inline-flex items-center gap-2 
             bg-gradient-to-r from-purple-500 to-indigo-500 
             text-white px-5 py-2 
             rounded-full text-sm font-semibold 
             shadow-md mb-6">

    <!-- Icon -->
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 7l9-4 9 4-9 4-9-4zM3 17l9 4 9-4M3 12l9 4 9-4"/>
    </svg>

    Thrifting

</span>

        <!-- Selamat datang -->
        <h1 class="text-3xl font-bold text-gray-800 mb-3">
            Selamat datang, {{ session('nama') }}
        </h1>

        <!-- Status -->
        <p class="text-gray-500 mb-10 text-lg">
            Anda masuk sebagai <span class="font-semibold">Guest</span>
        </p>

        <!-- Logout Icon -->
        <div class="relative group inline-flex flex-col items-center">

    <!-- Button -->
    <a href="{{ route('token.logout') }}"
       class="flex items-center justify-center 
              w-12 h-12 
              rounded-full 
              bg-red-500 text-white 
              hover:bg-red-600 hover:scale-110
              transition duration-300">

        <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 group-hover:animate-bounce"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>

    </a>

    <!-- Tooltip -->
    <span class="absolute -bottom-8 
                 opacity-0 group-hover:opacity-100
                 bg-black text-white text-xs
                 px-3 py-1 rounded-md
                 transition duration-300">
        Logout
    </span>

</div>
    </div>

</body>
</html>