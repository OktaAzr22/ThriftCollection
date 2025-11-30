@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-gray-900">Buat Item Terbaru</h2>
        
    </div>

    <!-- Step Progress -->
    <div class="mb-8">
        <div class="flex justify-between items-center relative">
            <!-- Progress Line -->
            <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
            <div id="progressLine" class="absolute top-1/2 left-0 h-1 bg-primary -translate-y-1/2 z-10 transition-all duration-500 ease-in-out" style="width: 0%"></div>
            
            <!-- Steps -->
            <div class="step-item relative z-20 flex flex-col items-center">
                <div class="step-number w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold transition-all duration-300">1</div>
                <span class="mt-2 text-sm font-medium text-primary">Informasi Dasar</span>
            </div>
            <div class="step-item relative z-20 flex flex-col items-center">
                <div class="step-number w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300">2</div>
                <span class="mt-2 text-sm font-medium text-gray-500">Kategori & Brand</span>
            </div>
            <div class="step-item relative z-20 flex flex-col items-center">
                <div class="step-number w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300">3</div>
                <span class="mt-2 text-sm font-medium text-gray-500">Gambar & Detail</span>
            </div>
        </div>
    </div>

    <!-- Form Steps -->
    <form id="productForm" action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Step 1: Informasi Dasar -->
        <div id="step1" class="step-content active">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar Produk</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" id="productName" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200" placeholder="Masukkan nama produk" value="{{ old('nama') }}">
                    <div id="error-productName" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                    @error('nama')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="productPrice" class="block text-sm font-medium text-gray-700 mb-1">Harga Produk</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" id="productPrice" name="harga" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200" placeholder="0" value="{{ old('harga') }}">
                    </div>
                    <div id="error-productPrice" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                    @error('harga')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="shippingCost" class="block text-sm font-medium text-gray-700 mb-1">Biaya Pengiriman</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" id="shippingCost" name="ongkir" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200" placeholder="0" value="{{ old('ongkir') }}">
                    </div>
                    <div id="error-shippingCost" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                    @error('ongkir')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-end">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Harga</label>
                        <div class="px-4 py-2 bg-gray-50 rounded-lg border border-gray-200">
                            <span id="totalPrice" class="text-lg font-bold text-gray-900">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-8">
                <button type="button" id="nextStep1" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 2: Kategori & Brand -->
        <div id="step2" class="step-content hidden">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori & Brand Produk</h3>
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Kolom Kiri: Dropdown -->
                <div class="w-full md:w-1/2 space-y-6">
                    <div>
                        <label for="productBrand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <select id="productBrand" name="brand_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                            <option value="">Pilih Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <div id="error-productBrand" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('brand_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="productStore" class="block text-sm font-medium text-gray-700 mb-1">Toko</label>
                        <select id="productStore" name="toko_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                            <option value="">Pilih Toko</option>
                            @foreach($tokos as $toko)
                                <option value="{{ $toko->id }}" {{ old('toko_id') == $toko->id ? 'selected' : '' }}>{{ $toko->nama }}</option>
                            @endforeach
                        </select>
                        <div id="error-productStore" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('toko_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="productCategory" name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        <div id="error-productCategory" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('kategori_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Kolom Kanan: Deskripsi -->
                <div class="w-full md:w-1/2">
                    <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Produk</label>
                    <textarea id="productDescription" name="deskripsi" rows="10" class="w-full h-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200" placeholder="Tulis deskripsi produk di sini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between mt-8">
                <button type="button" id="prevStep2" class="px-6 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" id="nextStep2" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 3: Gambar & Detail -->
        <div id="step3" class="step-content hidden">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Gambar & Detail Produk</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri: Gambar -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Gambar Produk</label>
                        <div class="relative">
                            <!-- Container untuk upload gambar -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors duration-200">
                                <input type="file" id="productImage" name="gambar" class="hidden" accept="image/*">
                                <div id="imagePreview" class="preview-area flex flex-col items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF (Maks. 5MB)</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol hapus gambar (muncul hanya saat ada gambar) -->
                            <button id="deleteImage" type="button" class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center shadow-md opacity-0 transition-opacity duration-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div id="error-productImage" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('gambar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan: Tanggal & Color -->
                <div class="space-y-6">
                    <div>
                        <label for="productDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Produk</label>
                        <input type="date" id="productDate" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200" value="{{ old('tanggal') }}">
                        <div id="error-productDate" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('tanggal')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                        <div class="relative">
                            <select id="color" name="id_color" class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200 appearance-none">
                                <option value="">Pilih Warna</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id_color }}" data-hex="{{ $color->hex }}" {{ old('id_color') == $color->id_color ? 'selected' : '' }}>
                                        {{ $color->nama_color ?? $color->nama ?? 'Warna' }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Color Preview -->
                            <div id="colorPreview" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full border border-gray-300"></div>
                        </div>
                        <div id="error-color" class="error-message mt-1 text-sm text-red-600 hidden"></div>
                        @error('id_color')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-8">
                <button type="button" id="prevStep3" class="px-6 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="submit" class="px-6 py-2 bg-secondary text-white rounded-lg hover:bg-green-600 transition-colors duration-200 flex items-center">
                    <i class="fas fa-check mr-2"></i> Simpan Produk
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form Step Logic
        const stepContents = document.querySelectorAll('.step-content');
        const stepNumbers = document.querySelectorAll('.step-number');
        const progressLine = document.getElementById('progressLine');
        let currentStep = 1;

        // Initialize progress
        updateProgress();

        // Next Step 1
        document.getElementById('nextStep1').addEventListener('click', function() {
            if (validateStep1()) {
                showStep(2);
            }
        });

        // Next Step 2
        document.getElementById('nextStep2').addEventListener('click', function() {
            if (validateStep2()) {
                showStep(3);
            }
        });

        // Previous Step 2
        document.getElementById('prevStep2').addEventListener('click', function() {
            showStep(1);
        });

        // Previous Step 3
        document.getElementById('prevStep3').addEventListener('click', function() {
            showStep(2);
        });

        // Form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            if (!validateAllSteps()) {
                e.preventDefault();
                // Jika validasi gagal, kembali ke step pertama yang error
                showStep(getFirstInvalidStep());
            }
        });

        

        // Calculate total price
        document.getElementById('productPrice').addEventListener('input', calculateTotalPrice);
        document.getElementById('shippingCost').addEventListener('input', calculateTotalPrice);

        // Image upload and delete functionality
        setupSingleImageUpload();

        // Color preview functionality
        setupColorPreview();

        // Real-time validation
        setupRealTimeValidation();

        function showStep(step) {
            // Hide all steps
            stepContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });

            // Show current step
            document.getElementById(`step${step}`).classList.remove('hidden');
            document.getElementById(`step${step}`).classList.add('active');

            // Update step numbers
            stepNumbers.forEach((number, index) => {
                if (index < step) {
                    number.classList.remove('bg-gray-200', 'text-gray-500');
                    number.classList.add('bg-primary', 'text-white');
                } else {
                    number.classList.remove('bg-primary', 'text-white');
                    number.classList.add('bg-gray-200', 'text-gray-500');
                }
            });

            currentStep = step;
            updateProgress();
        }

        function updateProgress() {
            const progressPercentage = ((currentStep - 1) / (stepNumbers.length - 1)) * 100;
            progressLine.style.width = `${progressPercentage}%`;
        }

        function showError(fieldId, message) {
            const errorElement = document.getElementById(`error-${fieldId}`);
            const inputElement = document.getElementById(fieldId);
            
            if (errorElement && inputElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
                inputElement.classList.add('border-red-500', 'focus:ring-red-500');
                inputElement.classList.remove('focus:ring-primary', 'focus:border-transparent');
                
                // Scroll ke error
                inputElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        function hideError(fieldId) {
            const errorElement = document.getElementById(`error-${fieldId}`);
            const inputElement = document.getElementById(fieldId);
            
            if (errorElement && inputElement) {
                errorElement.classList.add('hidden');
                errorElement.textContent = '';
                inputElement.classList.remove('border-red-500', 'focus:ring-red-500');
                inputElement.classList.add('focus:ring-primary', 'focus:border-transparent');
            }
        }

        function validateStep1() {
            let isValid = true;
            const name = document.getElementById('productName').value.trim();
            const price = document.getElementById('productPrice').value;
            
            // Validasi nama
            if (!name) {
                showError('productName', 'Nama produk harus diisi');
                isValid = false;
            } else {
                hideError('productName');
            }
            
            // Validasi harga
            if (!price) {
                showError('productPrice', 'Harga produk harus diisi');
                isValid = false;
            } else if (price <= 0) {
                showError('productPrice', 'Harga produk harus lebih dari 0');
                isValid = false;
            } else {
                hideError('productPrice');
            }
            
            return isValid;
        }

        function validateStep2() {
            let isValid = true;
            const brand = document.getElementById('productBrand').value;
            const store = document.getElementById('productStore').value;
            const category = document.getElementById('productCategory').value;
            
            // Validasi brand
            if (!brand) {
                showError('productBrand', 'Brand produk harus dipilih');
                isValid = false;
            } else {
                hideError('productBrand');
            }
            
            // Validasi toko
            if (!store) {
                showError('productStore', 'Toko harus dipilih');
                isValid = false;
            } else {
                hideError('productStore');
            }
            
            // Validasi kategori
            if (!category) {
                showError('productCategory', 'Kategori produk harus dipilih');
                isValid = false;
            } else {
                hideError('productCategory');
            }
            
            return isValid;
        }

        function validateStep3() {
            let isValid = true;
            const date = document.getElementById('productDate').value;
            const color = document.getElementById('color').value;
            
            // Validasi tanggal
            if (!date) {
                showError('productDate', 'Tanggal produk harus diisi');
                isValid = false;
            } else {
                hideError('productDate');
            }

            // Validasi warna
            if (!color) {
                showError('color', 'Warna produk harus dipilih');
                isValid = false;
            } else {
                hideError('color');
            }
            
            return isValid;
        }

        function validateAllSteps() {
            const step1Valid = validateStep1();
            const step2Valid = validateStep2();
            const step3Valid = validateStep3();
            
            return step1Valid && step2Valid && step3Valid;
        }

        function getFirstInvalidStep() {
            if (!validateStep1()) return 1;
            if (!validateStep2()) return 2;
            if (!validateStep3()) return 3;
            return 1;
        }

        function setupColorPreview() {
            const colorSelect = document.getElementById('color');
            const colorPreview = document.getElementById('colorPreview');

            function updateColorPreview() {
                const selectedOption = colorSelect.options[colorSelect.selectedIndex];
                const hexColor = selectedOption.getAttribute('data-hex');
                
                if (hexColor) {
                    colorPreview.style.backgroundColor = hexColor;
                    colorPreview.style.display = 'block';
                } else {
                    colorPreview.style.display = 'none';
                }
            }

            // Update preview on change
            colorSelect.addEventListener('change', updateColorPreview);
            
            // Initial update
            updateColorPreview();
        }

        function setupRealTimeValidation() {
            // Step 1 real-time validation
            document.getElementById('productName').addEventListener('blur', function() {
                const name = this.value.trim();
                if (!name) {
                    showError('productName', 'Nama produk harus diisi');
                } else {
                    hideError('productName');
                }
            });

            document.getElementById('productPrice').addEventListener('blur', function() {
                const price = this.value;
                if (!price) {
                    showError('productPrice', 'Harga produk harus diisi');
                } else if (price <= 0) {
                    showError('productPrice', 'Harga produk harus lebih dari 0');
                } else {
                    hideError('productPrice');
                }
            });

            // Step 2 real-time validation
            document.getElementById('productBrand').addEventListener('change', function() {
                if (this.value) {
                    hideError('productBrand');
                } else {
                    showError('productBrand', 'Brand produk harus dipilih');
                }
            });

            document.getElementById('productStore').addEventListener('change', function() {
                if (this.value) {
                    hideError('productStore');
                } else {
                    showError('productStore', 'Toko harus dipilih');
                }
            });

            document.getElementById('productCategory').addEventListener('change', function() {
                if (this.value) {
                    hideError('productCategory');
                } else {
                    showError('productCategory', 'Kategori produk harus dipilih');
                }
            });

            // Step 3 real-time validation
            document.getElementById('productDate').addEventListener('change', function() {
                if (this.value) {
                    hideError('productDate');
                } else {
                    showError('productDate', 'Tanggal produk harus diisi');
                }
            });

            document.getElementById('color').addEventListener('change', function() {
                if (this.value) {
                    hideError('color');
                } else {
                    showError('color', 'Warna produk harus dipilih');
                }
            });
        }

        function calculateTotalPrice() {
            const price = parseFloat(document.getElementById('productPrice').value) || 0;
            const shipping = parseFloat(document.getElementById('shippingCost').value) || 0;
            const total = price + shipping;
            
            document.getElementById('totalPrice').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        function setupSingleImageUpload() {
            const input = document.getElementById('productImage');
            const preview = document.getElementById('imagePreview');
            const deleteBtn = document.getElementById('deleteImage');
            
            function displayImage(file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <div class="relative w-full h-48">
                            <img src="${e.target.result}" class="h-full w-full object-contain rounded-md" alt="Preview">
                        </div>
                    `;
                    deleteBtn.classList.remove('opacity-0');
                };
                
                reader.readAsDataURL(file);
            }
            
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        showError('productImage', 'Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }
                    
                    if (!file.type.match('image.*')) {
                        showError('productImage', 'Hanya file gambar yang diizinkan.');
                        return;
                    }
                    
                    hideError('productImage');
                    displayImage(file);
                }
            });
            
            preview.addEventListener('click', function() {
                input.click();
            });
            
            deleteBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                resetImagePreview();
            });
            
            function resetImagePreview() {
                preview.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF (Maks. 5MB)</p>
                    </div>
                `;
                input.value = '';
                deleteBtn.classList.add('opacity-0');
                hideError('productImage');
            }
        }

        

        // Initialize total price calculation
        calculateTotalPrice();
    });
</script>

<style>
    .error-message {
        transition: all 0.3s ease;
    }
    
    input.border-red-500,
    select.border-red-500 {
        border-color: #ef4444 !important;
    }
    
    input:focus.border-red-500,
    select:focus.border-red-500 {
        --tw-ring-color: #ef4444 !important;
    }

    /* Style untuk option dalam dropdown */
    #color option {
        padding: 8px;
        margin: 2px 0;
    }
</style>
@endpush
@endsection