<aside class="w-72 bg-white border-r border-slate-200 flex flex-col">
    <div class="p-6 border-b border-slate-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">D</span>
            </div>
            <h1 class="text-xl font-bold text-slate-800">Dashboard<span class="text-blue-600">.</span></h1>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-4">
        
        <div class="mb-8">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 px-4">Main Menu</h3>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'text-slate-700 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Beranda</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-xl transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Kalender</span>
                </a>
            </nav>
        </div>

        <div class="mb-8">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 px-4">Analytics</h3>
            <nav class="space-y-1">
                <a href="{{ route('items.index') }}" class="flex items-center px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('items.*') ? 'text-slate-700 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('items.*') ? 'text-blue-600' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">Overview</span>
                </a>
                
                <div class="ml-4">
                    <button onclick="toggleSubMenu('reportsMenu')" class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-slate-500 hover:text-slate-700 rounded-lg transition duration-200">
                        <span>Laporan</span>
                        <svg id="reportsMenu-icon" class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('brands.*') || request()->routeIs('master.*') || request()->routeIs('toko.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="reportsMenu" class="mt-2 space-y-1 overflow-hidden transition-all {{ request()->routeIs('brands.*') || request()->routeIs('master.*') || request()->routeIs('toko.*') ? 'max-h-96' : 'max-h-0' }}">
                        <a href="{{ route('brands.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('brands.*') ? 'text-blue-600 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('brands.*') ? 'bg-blue-600' : 'bg-slate-400' }} rounded-full mr-3"></span>
                            <span>Brand</span>
                        </a>
                        <a href="{{ route('master.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('master.*') ? 'text-blue-600 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('master.*') ? 'bg-blue-600' : 'bg-slate-400' }} rounded-full mr-3"></span>
                            <span>Master</span>
                        </a>
                        <a href="{{ route('toko.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('toko.*') ? 'text-blue-600 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('toko.*') ? 'bg-blue-600' : 'bg-slate-400' }} rounded-full mr-3"></span>
                            <span>Toko</span>
                        </a>
                        <a href="{{ route('token.logout') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 ">
                            <span class="w-1 h-1 "></span>
                            <span>Logout</span>
                        </a>
                        <div class="flex items-center justify-between px-4 py-2 ml-4 border-t border-slate-100 mt-2 pt-2">
                            <span class="text-sm font-medium text-slate-600">Dark Mode</span>
                            <button id="darkToggle" onclick="toggleDarkMode()" 
                                class="relative w-12 h-6 bg-gray-300 rounded-full 
                                       transition-colors duration-300 flex items-center cursor-pointer
                                       focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <!-- Toggle Ball -->
                                <span class="absolute w-5 h-5 bg-white rounded-full shadow-md 
                                             transform transition-transform duration-300 
                                             left-0.5 dark:translate-x-6">
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                
            </nav>
        </div>
        <!-- MANAGEMENT SECTION -->
                <div class="mb-8">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 px-4">Management</h3>
                    <nav class="space-y-1">
                        <!-- Menu Pengguna dengan Submenu Collapsible -->
                        <div>
                            <button onclick="toggleSubMenu('userMenu')" class="w-full flex items-center justify-between px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-xl transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium">Pengguna</span>
                                </div>
                                <svg id="userMenu-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Sub Menu - User Management -->
                            <div id="userMenu" class="mt-2 space-y-1 overflow-hidden transition-max-height max-h-0">
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-slate-500 px-4 mb-2">Data Pengguna</h4>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Daftar Pengguna</span>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Tambah Pengguna</span>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Hak Akses</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Produk dengan Submenu Collapsible -->
                        <div class="mt-1">
                            <button onclick="toggleSubMenu('productMenu')" class="w-full flex items-center justify-between px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-xl transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="font-medium">Produk</span>
                                </div>
                                <svg id="productMenu-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Sub Menu - Products -->
                            <div id="productMenu" class="mt-2 space-y-1 overflow-hidden transition-max-height max-h-0">
                                <div class="ml-4 border-l border-gray-500">
                                    <h4 class="text-sm font-medium text-slate-500 px-4 mb-2">Manajemen Produk</h4>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Semua Produk</span>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Kategori</span>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Stok</span>
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition duration-200 ml-4">
                                        <span class="w-1 h-1 bg-slate-400 rounded-full mr-3"></span>
                                        <span>Diskon</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- SETTINGS SECTION -->
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 px-4">Settings</h3>
                    <nav class="space-y-1">
                        <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-xl transition duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium">Pengaturan Umum</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-xl transition duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="font-medium">Keamanan</span>
                        </a>
                    </nav>
                </div>
    </div>

    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center justify-center">
            <p class="text-sm font-semibold text-slate-800">xi</p>
        </div>
    </div>
</aside>