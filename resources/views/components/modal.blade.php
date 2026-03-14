@props([
    'id' => 'modal',
    'title' => 'Tambah Data',
    'action' => '#',
    'method' => 'POST',
    'noFooter' => false
])

<!-- MODAL -->
<div id="{{ $id }}" 
     class="fixed inset-0 bg-black/30 dark:bg-black/70 flex items-center justify-center z-50 hidden
            transition-opacity duration-300 ease-in-out opacity-0 ">

    <div class="bg-white dark:bg-black rounded-lg shadow-lg dark:shadow-purple-500/10 w-full max-w-md mx-4
                transform transition-all duration-300 scale-95 border dark:border-purple-500/20">

        <!-- HEADER -->
        <div class="flex justify-between items-center p-6 border-b dark:border-purple-500/20 sticky top-0 bg-white dark:bg-black z-10 rounded-t-xl">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
            <button type="button" 
                    class="text-gray-400 dark:text-white/60 hover:text-gray-600 dark:hover:text-purple-400 transition-colors duration-200 closeModal"
                    data-id="{{ $id }}"
                    aria-label="Tutup modal">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="max-h-[70vh] overflow-y-auto px-6 pb-6 dark:scrollbar-thumb-purple-500/20 dark:scrollbar-track-transparent">
            <!-- FORM -->
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data"  id="{{ $id }}Form">
                @csrf

                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                {{ $slot }}

                @if (!$noFooter)
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button"
                            class="px-4 py-2 border border-gray-300 dark:border-purple-500/30 text-gray-700 dark:text-white/70 rounded-lg hover:bg-gray-50 dark:hover:bg-purple-500/10 transition closeModal"
                            data-id="{{ $id }}">
                        Batal
                    </button>

                    <x-button-custom label="Submit" loading="Processing..." />
                </div>
                @endif
            </form>
        </div>


    </div>
</div>