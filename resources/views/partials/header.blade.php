            <header class="bg-white border-b border-slate-200 sticky top-0 z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Cari sesuatu..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <button class="relative p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-blue-500 rounded-full"></span>
                        </button>

                        <div class="w-px h-6 bg-slate-200"></div>

                        <div class="relative">
                        <div onclick="toggleDropdown()" class="flex items-center space-x-3 cursor-pointer" id="profileButton">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-800">Ahmad Fauzi</p>
                                <p class="text-xs text-slate-500">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center text-white font-semibold">
                                AF
                            </div>
                            <svg id="dropdownIcon" class="w-4 h-4 text-slate-500 transition-rotate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-200 py-2 z-50">
                            <div class="px-4 py-2 hover:bg-slate-50 cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                    </svg>
                                    <span class="text-sm text-slate-700">Mode Gelap</span>
                                </div>
                            </div>
                            <div class="px-4 py-2 hover:bg-slate-50 cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                    </svg>
                                    <span class="text-sm text-slate-700">Bahasa Indonesia</span>
                                </div>
                            </div>
                            <div class="px-4 py-2 hover:bg-slate-50 cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="text-sm text-slate-700">Kelola Toko</span>
                                </div>
                            </div>
                            <div class="border-t border-slate-200 my-2"></div>
                            <div class="px-4 py-2 hover:bg-red-50 cursor-pointer">
                                <div class="flex items-center space-x-3 text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Logout</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </header>