<aside class="w-72 bg-white dark:bg-black border-r border-slate-200 dark:border-purple-500/20 flex flex-col">
    <div class="p-6 border-b border-slate-200 dark:border-purple-500/20">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-purple-600 dark:to-purple-800 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">T</span>
            </div>
            <h1 class="text-xl font-bold text-slate-800 dark:text-white">Thriftting<span class="text-blue-600 dark:text-purple-400">.</span></h1>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-4">
        
        <div class="mb-8">
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'text-slate-700 dark:text-white bg-slate-100 dark:bg-purple-500/20' : 'text-slate-600 dark:text-white/80 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-purple-400' : 'dark:text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Home</span>
                </a>
                <a href="{{ route('items.index') }}" class="flex items-center px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('items.*') ? 'text-slate-700 dark:text-white bg-slate-100 dark:bg-purple-500/20' : 'text-slate-600 dark:text-white/80 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('items.*') ? 'text-blue-600 dark:text-purple-400' : 'dark:text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">Item</span>
                </a>
            </nav>
        </div>

        <div class="mb-5">
            <h3 class="text-xs font-semibold text-slate-400 dark:text-white/50 uppercase tracking-wider mb-4 px-4">Analytics</h3>
            <nav class="space-y-1">
                
                <div class="ml-4">
                    <button onclick="toggleSubMenu('reportsMenu')" class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-slate-500 dark:text-white/60 hover:text-slate-700 dark:hover:text-white rounded-lg transition duration-200">
                        <span>Master Data</span>
                        <i id="reportsMenu-icon"
                        class="fa-solid {{ request()->routeIs('brands.*') || request()->routeIs('master.*') || request()->routeIs('toko.*') ? 'fa-chevron-up' : 'fa-chevron-down' }}
                        text-sm transition-all duration-200 dark:text-white/60">
                        </i>
                    </button>
                    <div id="reportsMenu" class="mt-2 space-y-1 overflow-hidden transition-all {{ request()->routeIs('brands.*') || request()->routeIs('master.*') || request()->routeIs('toko.*') ? 'max-h-96' : 'max-h-0' }}">
                        <a href="{{ route('brands.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('brands.*') ? 'text-blue-600 dark:text-purple-400 bg-slate-100 dark:bg-purple-500/20' : 'text-slate-600 dark:text-white/70 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('brands.*') ? 'bg-blue-600 dark:bg-purple-400' : 'bg-slate-400 dark:bg-white/40' }} rounded-full mr-3"></span>
                            <span>Brand</span>
                        </a>
                        <a href="{{ route('master.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('master.*') ? 'text-blue-600 dark:text-purple-400 bg-slate-100 dark:bg-purple-500/20' : 'text-slate-600 dark:text-white/70 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('master.*') ? 'bg-blue-600 dark:bg-purple-400' : 'bg-slate-400 dark:bg-white/40' }} rounded-full mr-3"></span>
                            <span>Master</span>
                        </a>
                        <a href="{{ route('toko.index') }}" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4 {{ request()->routeIs('toko.*') ? 'text-blue-600 dark:text-purple-400 bg-slate-100 dark:bg-purple-500/20' : 'text-slate-600 dark:text-white/70 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">
                            <span class="w-1 h-1 {{ request()->routeIs('toko.*') ? 'bg-blue-600 dark:bg-purple-400' : 'bg-slate-400 dark:bg-white/40' }} rounded-full mr-3"></span>
                            <span>Toko</span>
                        </a>
                        
                    </div>
                </div>

            </nav>
        </div>
        <!-- MANAGEMENT SECTION -->
                <div class="mb-8">
                    <h3 class="text-xs font-semibold text-slate-400 dark:text-white/50 uppercase tracking-wider mb-4 px-4">Management</h3>
                    <nav class="space-y-1">
                       

                        <!-- Menu Produk dengan Submenu Collapsible -->
                        <div class="mt-1">
                            <button onclick="toggleSubMenu('productMenu')" class="w-full flex items-center justify-between px-4 py-3 text-slate-600 dark:text-white/80 hover:bg-slate-50 dark:hover:bg-purple-500/10 rounded-xl transition duration-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 dark:text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="font-medium">Produk</span>
                                </div>
                                <svg id="productMenu-icon" class="w-4 h-4 transition-transform duration-200 dark:text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Sub Menu - Products -->
                            <div id="productMenu" class="mt-2 space-y-1 overflow-hidden transition-all
                                {{ request()->routeIs('hakakses') ? 'max-h-96' : 'max-h-0' }}">
                                <div class="ml-4 border-l border-gray-500 dark:border-purple-500/20">
                                    <h4 class="text-sm font-medium text-slate-500 dark:text-white/50 px-4 mb-2">Manajemen Produk</h4>
                                   
                                    <a href="{{ route('hakakses') }}" 
                                        class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-200 ml-4
                                        {{ request()->routeIs('hakakses') 
                                            ? 'text-blue-600 dark:text-purple-400 bg-slate-100 dark:bg-purple-500/20' 
                                            : 'text-slate-600 dark:text-white/70 hover:bg-slate-50 dark:hover:bg-purple-500/10' }}">

                                            <span class="w-1 h-1 
                                            {{ request()->routeIs('hakakses') 
                                                ? 'bg-blue-600 dark:bg-purple-400' 
                                                : 'bg-slate-400 dark:bg-white/40' }} 
                                            rounded-full mr-3"></span>

                                            <span>Hak Akses</span>
                                    </a>
                                    
                                    <div class="flex items-center justify-between px-4 ml-4   pt-2">
    
                                        <div class="flex items-center">
                                            <span class="w-1 h-1 bg-slate-400 dark:bg-white/40 rounded-full mr-3"></span>
                                            <span class="text-sm text-slate-600 dark:text-white/70">Dark Mode</span>
                                        </div>

                                        <button id="darkToggle" onclick="toggleDarkMode()" 
                                            class="relative w-12 h-6 bg-gray-300 dark:bg-purple-500/30 rounded-full 
                                                transition-colors duration-300 flex items-center cursor-pointer
                                                ">

                                            <span class="absolute w-5 h-5 bg-white dark:bg-purple-400 rounded-full shadow-md 
                                                        transform transition-transform duration-300 
                                                        left-0.5 dark:translate-x-6">
                                            </span>

                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- SETTINGS SECTION -->
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 dark:text-white/50 uppercase tracking-wider mb-4 px-4 ">Settings</h3>
                    <nav class="space-y-1">
                        
                        
                        <div class="    rounded-xl transition duration-200 border-t border-slate-100 dark:border-purple-500/20 ">
                            <a href="{{ route('token.logout') }}" 
                           class="flex items-center px-4 py-3 text-slate-600 dark:text-white/80 hover:bg-slate-50 dark:hover:bg-purple-500/10 rounded-xl transition duration-200 ">
                            <svg class="w-5 h-5 mr-3 dark:text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium text-red-600 dark:text-purple-400">Logout</span>
                        </a>
                        
                        
                        </div>
                        
                    </nav>
                </div>

    </div>

    <div class="p-4 border-t border-slate-200 dark:border-purple-500/20">
        <div class="flex items-center justify-center">
            <p class="text-sm font-semibold text-slate-800 dark:text-white/50">xi</p>
        </div>
    </div>
</aside>