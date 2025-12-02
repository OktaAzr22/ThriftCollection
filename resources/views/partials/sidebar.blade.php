 <!-- Sidebar -->
        



        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col h-[calc(100vh-80px)] sticky top-20">
            <!-- Menu Section -->
            <div class="p-4 flex-1 overflow-y-auto ">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Menu</div>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('brands.index') }}" class="{{ request()->routeIs('brands.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fas fa-shopping-cart w-5 mr-3"></i>
                        <span>Brand</span>
                    </a>
                    <a href="{{ route('master.index') }}" class="{{ request()->routeIs('master.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fas fa-box w-5 mr-3"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('toko.index') }}" class="{{ request()->routeIs('toko.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fas fa-tags w-5 mr-3"></i>
                        <span>Toko</span>
                    </a>
                    <a href="{{ route('items.index') }}" class="{{ request()->routeIs('items.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fas fa-chart-bar w-5 mr-3"></i>
                        <span>Item</span>
                    </a>
                </nav>
                
                <div class="mt-8">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Lainnya</div>
                    <nav class="space-y-1">
                        <a href="#" class="flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                            <i class="fas fa-cog w-5 mr-3"></i>
                            <span>Pengaturan</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                            <i class="fas fa-question-circle w-5 mr-3"></i>
                            <span>Bantuan</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>