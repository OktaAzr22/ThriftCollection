<div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col h-[calc(100vh-80px)]">
            <!-- Menu Section -->
            <div class="p-4 flex-1 overflow-y-auto">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Menu</div>
                <nav class="space-y-1">
                    <a href="{{ route('brands.index') }}" class="flex items-center px-3 py-3 {{ request()->routeIs('brands.*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                        <span>Brand</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-3 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        <i class="fas fa-shopping-cart w-5 mr-3"></i>
                        <span>eCommerce</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto flex flex-col h-[calc(100vh-80px)]">
            <!-- Content -->
            <main class="p-6 flex-1 overflow-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-600 mb-2 md:mb-0">
                        &copy; {{ date('Y') }} Thriftting. All rights reserved.
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>