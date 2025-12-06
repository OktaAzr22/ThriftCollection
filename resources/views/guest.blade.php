<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Terbatas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">

        {{-- Card --}}
        <div class="bg-white shadow-lg rounded-2xl p-8 max-w-lg w-full text-center">
            
            {{-- Icon --}}
            <div class="flex justify-center mb-4">
                <div class="bg-red-100 text-red-600 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-10 w-10" 
                         fill="none" viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 
                                 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 
                                 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            {{-- Text --}}
            <h1 class="text-2xl font-semibold mb-2">Akses Terbatas</h1>

            <p class="text-gray-600 mb-6">
                Token Anda tidak memiliki izin untuk mengakses halaman premium.
            </p>

            {{-- Error message (if any) --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm mb-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Buttons --}}
            <div class="flex flex-col gap-3">

                {{-- Tombol Kembali ke Input Token --}}
                <a href="{{ route('token.form') }}"
                    class="w-full text-center bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition">
                    Masukkan Token Baru
                </a>

                {{-- Logout Token --}}
                <a href="{{ route('token.logout') }}"
                    class="w-full text-center bg-gray-200 text-gray-700 py-2.5 rounded-lg hover:bg-gray-300 transition">
                    Hapus Token
                </a>

            </div>

        </div>

        {{-- Footer --}}
        <p class="text-sm text-gray-500 mt-6">
            © {{ date('Y') }} Thriftting Dashboard
        </p>

    </div>

</body>
</html>
