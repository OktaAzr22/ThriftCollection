@props([
    'id' => 'modal',
    'title' => 'Tambah Data',
    'action' => '#',
    'method' => 'POST'
])

<!-- MODAL -->
<div id="{{ $id }}" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden
            transition-opacity duration-300 ease-in-out opacity-0">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4
                transform transition-all duration-300 scale-95 ">

        <!-- HEADER -->
        <div class="flex justify-between items-center p-6 border-b sticky top-0 bg-white z-10 rounded-t-xl">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            <button type="button" 
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 closeModal"
                    data-id="{{ $id }}"
                    aria-label="Tutup modal">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="max-h-[70vh] overflow-y-auto px-6 pb-6">
            <!-- FORM -->
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data"  id="{{ $id }}Form">
                @csrf

                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                {{ $slot }}

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition closeModal"
                            data-id="{{ $id }}">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>


    </div>
</div>
