



   



     <div  class=" flex-grow overflow-y-auto px-6 md:px-8 pb-6 pt-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- GAMBAR -->
                <div class="md:col-span-5">
                   @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                            class="rounded-xl w-full h-64 md:h-80 object-cover shadow-md">
                    @else
                        <div class="rounded-xl w-full h-64 md:h-80 flex justify-center items-center shadow-md bg-gray-100">
    <p class="italic text-gray-500 text-center">None</p>
</div>

                    @endif

                    
                    <div class="mt-4 flex justify-between items-center w-full">
                        <div class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm">
                            <i class="fa-solid fa-calendar-day mr-2"></i>
                            <span >{{ $item->tanggal }}</span>
                        </div>

                        <div class="inline-flex items-center text-gray-700 text-sm font-medium">
                            <i class="fa-solid fa-coins mr-2"></i>
                            <span>Rp {{ number_format($item->total) }}</span>
                        </div>
                    </div>
                </div>

                <!-- DETAIL -->
                <div class="md:col-span-7 space-y-4">
                    <div class="border-b pb-4">
                        <p class="text-xs text-gray-500">Nama Produk</p>
                        <p id="modal-nama" class="text-gray-800 text-lg font-medium">{{ $item->nama }}</p>
                    </div>

                    <!-- Harga + Ongkir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Harga</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span>Rp{{ number_format($item->harga) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Ongkir</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span>Rp {{ number_format($item->ongkir) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori + Brand -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Kategori</p>
                            <div class="text-sm font-medium">{{ ($item->kategori->nama) }}</div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Brand</p>
                            <x-brand-badge :brand="$item->brand" />
                        </div>
                    </div>

                    <!-- Warna + Toko -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Warna</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span><span>{{ $item->color->nama ?? '-' }}</span></span>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Toko</p>
                            <div class="bg-gray-50 p-4 rounded-xl border">
                                <span >{{ $item->toko->nama }}</span>
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
                    <p>{{ $item->deskripsi ?? '-' }}</p>
                </div>
            </div>
        </div>