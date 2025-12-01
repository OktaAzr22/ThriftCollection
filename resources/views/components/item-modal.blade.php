
<!-- OVERLAY -->
<div id="item-modal" class="fixed inset-0 bg-black/40 hidden flex justify-center items-center z-50">
    <!-- MODAL BOX -->
    <div id="item-modal-box" class="bg-white rounded-2xl w-full max-w-4xl shadow-xl flex flex-col overflow-hidden" style="height: 85vh;">
        <!-- HEADER -->
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold">Detail Produk</h2>
                    <p class="text-gray-400 text-sm">Informasi lengkap produk thrift Anda</p>
                </div>

                <button onclick="closeItemModal()" 
                        class="p-2 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <!-- SKELETON -->
        <div id="modal-skeleton" class="p-6 animate-pulse hidden">
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

            <!-- Deskripsi -->
            <div class="mt-8">
                <div class="h-4 w-32 bg-gray-300 rounded mb-3"></div>
                <div class="bg-gray-50 p-5 rounded-xl border">
                    <div class="space-y-2">
                        <div class="h-3 bg-gray-300 rounded w-full"></div>
                        <div class="h-3 bg-gray-300 rounded w-4/5"></div>
                        <div class="h-3 bg-gray-300 rounded w-3/4"></div>
                        <div class="h-3 bg-gray-300 rounded w-2/3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT (SCROLLABLE) -->
        <div id="modal-content" class="hidden flex-grow overflow-y-auto px-6 md:px-8 pb-6 pt-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- GAMBAR -->
                <div class="md:col-span-5">
                    <img id="modal-gambar" class="rounded-xl w-full h-64 md:h-80 object-cover shadow-md" src="">
                    
                    <div class="mt-4 flex justify-between items-center w-full">
                        <div class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm">
                            <i class="fa-solid fa-calendar-day mr-2"></i>
                            <span id="modal-tanggal"></span>
                        </div>

                        <div class="inline-flex items-center text-gray-700 text-sm font-medium">
                            <i class="fa-solid fa-coins mr-2"></i>Rp
                            <span id="modal-total"></span>
                        </div>
                    </div>
                </div>

                <!-- DETAIL -->
                <div class="md:col-span-7 space-y-4">
                    <div class="border-b pb-4">
                        <p class="text-xs text-gray-500">Nama Produk</p>
                        <p id="modal-nama" class="text-gray-800 text-lg font-medium"></p>
                    </div>

                    <!-- Harga + Ongkir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Harga</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                Rp <span id="modal-harga"></span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Ongkir</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                Rp <span id="modal-ongkir"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori + Brand -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Kategori</p>
                            <div id="modal-kategori" class="text-sm font-medium"></div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Brand</p>
                            <div id="modal-brand" class="inline-block bg-gray-100 text-gray-700 px-3 py-2 rounded-full text-sm font-medium">
                            </div>
                        </div>
                    </div>

                    <!-- Warna + Toko -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Warna</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span id="modal-color"></span>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Toko</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span id="modal-toko"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="mt-8">
                <p class="text-gray-700 font-semibold flex items-center">
                    <i class="fa-solid fa-file-links mr-2"></i>
                    Deskripsi Produk
                </p>

                <div class="bg-gray-50 p-5 rounded-xl border text-sm leading-relaxed">
                    <p id="modal-deskripsi"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openItemModal(id) {
        const modal = document.getElementById('item-modal');
        const box = document.getElementById('item-modal-box');
        const skeleton = document.getElementById('modal-skeleton');
        const content = document.getElementById('modal-content');

        modal.classList.remove('hidden');

        box.classList.remove('animate-zoomOut');
        box.classList.add('animate-zoomIn');

        skeleton.classList.remove('hidden');
        content.classList.add('hidden');

        fetch(`/items/${id}/detail`)
            .then(res => res.json())
            .then(item => {

                const harga = Number(item.harga) || 0;
                const ongkir = Number(item.ongkir) || 0;
                const total = harga + ongkir;

                document.getElementById('modal-nama').textContent = item.nama;
                document.getElementById('modal-kategori').textContent = item.kategori.nama;
                document.getElementById('modal-brand').textContent = item.brand.name;
                document.getElementById('modal-toko').textContent = item.toko.nama;

                document.getElementById('modal-harga').textContent = harga.toLocaleString('id-ID');
                document.getElementById('modal-ongkir').textContent = ongkir.toLocaleString('id-ID');
                document.getElementById('modal-total').textContent = total.toLocaleString('id-ID');

                document.getElementById('modal-color').textContent = item.color?.hex ?? '-';
                document.getElementById('modal-tanggal').textContent = item.tanggal;
                document.getElementById('modal-deskripsi').textContent = item.deskripsi ?? '-';

                document.getElementById('modal-gambar').src =
                    item.gambar ? "/storage/" + item.gambar : "/no-image.png";

                skeleton.classList.add('hidden');
                content.classList.remove('hidden');
            })
            .catch(() => {
                skeleton.classList.add('hidden');
                alert("Gagal memuat data");
            });
    }

    function closeItemModal() {
        const modal = document.getElementById('item-modal');
        const box = document.getElementById('item-modal-box');

        box.classList.remove('animate-zoomIn');
        box.classList.add('animate-zoomOut');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 400); 
    }

</script>

            

