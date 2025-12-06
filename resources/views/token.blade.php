<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Token</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">

        <h1 class="text-2xl font-bold mb-4 text-center">Masukkan Token</h1>

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>

            {{-- Tombol untuk menampilkan form --}}
            <button 
                id="showFormButton"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition mb-4"
            >
                Masukkan Token
            </button>
        @endif

        {{-- FORM TOKEN --}}
        <div 
            id="tokenFormContainer" 
            class="transition-all duration-300 {{ session()->has('error') ? 'hidden' : '' }}"
        >
            <form method="POST" action="/set-token" class="space-y-4">
                @csrf

                <input 
                    type="text" 
                    name="token" 
                    placeholder="Masukkan token"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:border-blue-500"
                    required
                >

                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition"
                >
                    Submit
                </button>
            </form>
        </div>

    </div>


    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hasError = @json(session()->has('error'));
            const formContainer = document.getElementById('tokenFormContainer');
            const showButton = document.getElementById('showFormButton');

            if (showButton) {
                showButton.addEventListener('click', function () {
                    // tampilkan form
                    formContainer.classList.remove('hidden');
                    // sembunyikan tombol
                    showButton.classList.add('hidden');
                });
            }
        });
    </script>

</body>
</html>
