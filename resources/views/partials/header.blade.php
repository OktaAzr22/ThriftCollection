<header class="bg-white dark:bg-black border-b border-slate-200 dark:border-purple-500/20 sticky top-0 z-10">

    <div class="flex items-center justify-end px-8 py-4">
        
        <div class="flex items-center space-x-4">

            <button class="relative p-2 text-slate-600 dark:text-white hover:bg-slate-100 dark:hover:bg-purple-500/10 rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 dark:bg-purple-500 rounded-full"></span>
            </button>

            <div class="w-px h-6 bg-slate-200 dark:bg-purple-500/20"></div>

            <div class="relative">

                <div onclick="toggleDropdown()" class="flex items-center space-x-3 cursor-pointer" id="profileButton">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-800 dark:text-white">{{ session('nama') }}</p>
                        <p class="text-xs text-slate-500 dark:text-white/70">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 dark:from-purple-600 dark:to-purple-800 rounded-xl flex items-center justify-center text-white font-semibold">
                        AF
                    </div>
                    <svg id="dropdownIcon" class="w-4 h-4 text-slate-500 dark:text-white transition-rotate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>

                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-black rounded-xl shadow-lg border border-slate-200 dark:border-purple-500/30 py-2 z-50">
                
                    <div class="px-4 py-2 hover:bg-slate-50 dark:hover:bg-purple-500/10 cursor-pointer">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                            <span class="text-sm text-slate-700 dark:text-white">Bahasa Indonesia</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    
</header>