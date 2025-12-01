@props(['id' => 'modal-ajax', 'title' => 'Detail'])

<!-- OVERLAY -->
<div id="{{ $id }}" class="fixed inset-0 bg-black/40 hidden flex justify-center items-center z-50">
    <!-- MODAL BOX -->
    <div id="{{ $id }}-box" class="bg-white rounded-2xl w-full max-w-3xl shadow-xl overflow-hidden animate-zoomIn">

        {{-- HEADER --}}
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="font-semibold text-lg">{{ $title }}</h2>
            <button onclick="tutupModal('{{ $id }}')" class="p-2 rounded-full hover:bg-gray-100">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        {{-- Skeleton Loader --}}
        <div id="{{ $id }}-skeleton" class="p-6 animate-pulse space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Bagian Gambar (Kiri) -->
                <div class="md:col-span-5 space-y-4">
                    <!-- Gambar produk -->
                    <div class="h-64 md:h-80 bg-gray-300 rounded-xl"></div>
                    <!-- Info tanggal dan total -->
                    <div class="flex justify-between">
                        <div class="h-8 w-32 bg-gray-300 rounded-full"></div>
                        <div class="h-8 w-24 bg-gray-300 rounded-full"></div>
                    </div>
                </div>

                <!-- Bagian Detail (Kanan) -->
                <div class="md:col-span-7 space-y-6">
                    <!-- Nama Produk -->
                    <div class="border-b pb-4">
                        <div class="h-3 w-16 bg-gray-300 rounded mb-2"></div>
                        <div class="h-5 w-2/3 bg-gray-300 rounded"></div>
                    </div>

                    <!-- Harga dan Ongkir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-12 bg-gray-300 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 rounded-xl"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 rounded-xl"></div>
                        </div>
                    </div>

                    <!-- Kategori dan Brand -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-16 bg-gray-300 rounded mb-2"></div>
                            <div class="h-5 w-24 bg-gray-200 rounded"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 rounded mb-2"></div>
                            <div class="h-8 w-20 bg-gray-200 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Warna dan Toko -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-12 bg-gray-300 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 rounded-xl"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- AJAX CONTENT --}}
        <div id="{{ $id }}-content" class="p-4 hidden max-h-[70vh] overflow-y-auto no-scrollbar"></div>

    </div>
</div>

<script>
    function bukaModal(id, url) {
        const modal  = document.getElementById(id);
        const box    = document.getElementById(id + "-box");
        const sk     = document.getElementById(id + "-skeleton");
        const cont   = document.getElementById(id + "-content");

        modal.classList.remove("hidden");

        box.classList.remove("animate-zoomOut");
        box.classList.add("animate-zoomIn");

        sk.classList.remove("hidden");
        cont.classList.add("hidden");
        cont.innerHTML = ""; // Clear content

        fetch(url)
            .then(res => res.text())
            .then(html => {
                cont.innerHTML = html;
                sk.classList.add("hidden");
                cont.classList.remove("hidden");
            })
            .catch(() => {
                cont.innerHTML = "<p class='text-red-600 text-center'>Gagal memuat data.</p>";
                sk.classList.add("hidden");
                cont.classList.remove("hidden");
            });
    }

    function tutupModal(id) {
        const modal = document.getElementById(id);
        const box   = document.getElementById(id + "-box");

        box.classList.remove("animate-zoomIn");
        box.classList.add("animate-zoomOut");

        setTimeout(() => {
            modal.classList.add("hidden");
        }, 250);
    }
</script>