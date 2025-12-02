<div class="space-y-6 pb-6">
    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="editItemForm">
        @csrf
        @method('PUT')

        <!-- Grid untuk responsive layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Nama Produk -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                <input type="text" name="nama" value="{{ old('nama', $item->nama) }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200" 
                    placeholder="Masukkan nama produk">
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                    <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" required min="0"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200" 
                        placeholder="0">
                </div>
            </div>

            <!-- Ongkir -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ongkir</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                    <input type="number" name="ongkir" value="{{ old('ongkir', $item->ongkir) }}" min="0"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200" 
                        placeholder="0">
                </div>
            </div>

            <!-- Brand -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                <select name="brand_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200 appearance-none bg-white">
                    <option value="">-- Pilih Brand --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Store -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Store</label>
                <select name="toko_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200 appearance-none bg-white">
                    <option value="">-- Pilih Store --</option>
                    @foreach ($tokos as $toko)
                        <option value="{{ $toko->id }}" {{ $item->toko_id == $toko->id ? 'selected' : '' }}>
                            {{ $toko->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="kategori_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200 appearance-none bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $item->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Warna -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                <select name="id_color" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200 appearance-none bg-white">
                    <option value="">-- Pilih Warna --</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id_color }}" {{ $item->id_color == $color->id_color ? 'selected' : '' }}>
                            {{ $color->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Beli</label>
                <input type="date" name="tanggal"
                    value="{{ old('tanggal', $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200 resize-none">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
{{--  --}}
<!-- Gambar Produk -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>

    <div class="flex gap-6 flex-col md:flex-row items-start">
        <!-- Gambar Lama -->
        <div>
            <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
            @if($item->gambar)
            <img src="{{ asset('storage/'.$item->gambar) }}" 
                class="w-40 h-40 rounded-lg border-2 border-gray-300 object-cover shadow-sm">
            @else
            <p class="text-xs text-gray-500 italic">Tidak ada gambar</p>
            @endif
        </div>

        <!-- Upload Gambar Baru -->
        <div class="space-y-3">
            <p class="text-sm text-gray-600">Upload gambar baru:</p>

            <input type="file" name="gambar" id="gambarInput"
                accept="image/*"
                class="block w-full text-sm text-gray-700 
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:bg-primary file:text-white
                    hover:file:bg-primary/80 cursor-pointer">

            <!-- Preview -->
            <div id="previewArea" class="hidden">
                <p class="text-xs text-gray-500 mb-2">Preview Gambar:</p>
                <img id="imagePreview" class="w-32 h-32 object-cover rounded-lg border shadow-sm">
            </div>

            <p class="text-xs text-gray-500">
                Kosongkan jika tidak ingin mengganti gambar.
            </p>
        </div>
    </div>
</div>

{{--  --}}
        <!-- Gambar Produk -->



<!-- Footer Buttons -->
<div class="pt-6 border-t border-gray-200">
    <div class="flex flex-col-reverse md:flex-row gap-3 md:gap-4 justify-end">
        <button type="button" onclick="closeEditDrawer()"
            class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2 transition-colors duration-200 w-full md:w-auto">
            Batal
        </button>

        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white bg-primary border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 w-full md:w-auto">
            Simpan Perubahan
        </button>
    </div>
</div>
</form>
</div>


</script>