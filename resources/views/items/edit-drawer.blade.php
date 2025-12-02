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

        <!-- Gambar Produk -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
    
    @if($item->gambar)
        <div class="mb-6">
            <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
            <img src="{{ asset('storage/'.$item->gambar) }}" 
                 class="w-40 h-40 rounded-lg border-2 border-gray-300 object-cover shadow-sm">
        </div>
        
        <p class="text-sm text-gray-600 mb-3">Upload gambar baru:</p>
    @endif

    <!-- Area Upload -->
    <div class="space-y-4">
        <!-- Upload Area -->
        <label for="gambarInput" class="block">
            <div id="uploadArea" 
                 class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-all duration-300 cursor-pointer">
                <input type="file" name="gambar" id="gambarInput" 
                       class="hidden" accept="image/*">
                
                <div class="flex flex-col items-center">
                    <!-- Icon Upload -->
                    <div class="w-10 h-10 mb-3 text-gray-400">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    
                    <!-- Text -->
                    <p class="text-sm font-medium text-gray-700 mb-1">
                        <span class="text-primary">Klik untuk upload</span>
                    </p>
                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                </div>
            </div>
        </label>
        
        <!-- Preview Area -->
        <div id="previewArea" class="hidden">
            <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
            <div id="previewContainer" class="space-y-3">
                <!-- Preview akan ditambahkan di sini -->
            </div>
        </div>
        
        <!-- Info -->
        <p class="text-xs text-gray-500">
            Biarkan kosong jika tidak ingin mengganti gambar
        </p>
    </div>
</div>


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

<script>
// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
    

    
    
    // Form validation
    const form = document.getElementById('editItemForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let valid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi!');
            }
        });
    }
});
</script>