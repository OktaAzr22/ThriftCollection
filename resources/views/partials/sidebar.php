        <div class="w-64 bg-white dark:bg-gray-950 shadow-lg h-screen sticky top-0 flex flex-col">
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
                        <button id="openSetting"
                            class="w-full flex items-center px-3 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                            <i class="fas fa-cog w-5 mr-3"></i>
                            <span>Pengaturan</span>
                        </button>

                        <a href="{{ route('token.logout') }}" class="flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 transition-all duration-200 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                            <i class="fas fa-question-circle w-5 mr-3"></i>
                            <span>logout</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div id="settingsPanel" 
     class="hidden absolute bg-white dark:bg-gray-950 
            shadow-xl border border-gray-200 dark:border-gray-800 
            rounded-xl z-50 overflow-hidden p-5 w-56 
            transform origin-top scale-y-0 transition-all duration-300">

    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase mb-4">
        Pengaturan
    </h3>

    <ul class="space-y-4 text-gray-700 dark:text-gray-300">

        <!-- Row: Label + Switch -->
        <li class="flex justify-between items-center">
            <span class="text-sm font-medium">Dark Mode</span>

            <button id="darkToggle" onclick="toggleDarkMode()" 
                class="relative w-10 h-5 bg-gray-300 dark:bg-gray-600 rounded-full 
                       transition-colors duration-300 flex items-center">
                <span class="absolute w-4 h-4 bg-white rounded-full shadow 
                             transform transition-transform duration-300 left-0.5 
                             dark:translate-x-5">
                </span>
            </button>
        </li>

        <!-- Logout -->
        <li>
            <a href="{{ route('token.logout') }}"
               class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <i class="fas fa-sign-out-alt w-5 mr-2"></i>
                Logout
            </a>
        </li>

    </ul>
</div>


        <div class="hidden fixed inset-0 bg-black/30 dark:bg-black/50   z-40"
            id="settingsOverlay">
        </div>
