@props(['id' => 'modal-ajax', 'title' => 'Detail'])

<div id="{{ $id }}" 
     class="fixed inset-0 bg-black/40 dark:bg-black/70 hidden flex justify-center items-center z-50
            transition-opacity duration-300 ease-in-out opacity-0">

    <div id="{{ $id }}-box" 
         class="bg-white dark:bg-black rounded-2xl w-full max-w-3xl shadow-xl dark:shadow-purple-500/10 overflow-hidden
                transform transition-all duration-300 scale-95 border dark:border-purple-500/20">

        <div class="flex justify-between items-center p-4 border-b dark:border-purple-500/20">
            <h2 class="font-semibold text-lg dark:text-white">{{ $title }}</h2>
            <button onclick="tutupModal('{{ $id }}')" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-purple-500/10 dark:text-white/70 dark:hover:text-purple-400 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div id="{{ $id }}-skeleton" class="p-6 animate-pulse space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                <div class="md:col-span-5 space-y-4">
                    <div class="h-64 md:h-80 bg-gray-300 dark:bg-purple-900/30 rounded-xl"></div>
                    <div class="flex justify-between">
                        <div class="h-8 w-32 bg-gray-300 dark:bg-purple-900/30 rounded-full"></div>
                        <div class="h-8 w-24 bg-gray-300 dark:bg-purple-900/30 rounded-full"></div>
                    </div>
                </div>

                <div class="md:col-span-7 space-y-6">
                    <div class="border-b dark:border-purple-500/20 pb-4">
                        <div class="h-3 w-16 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                        <div class="h-5 w-2/3 bg-gray-300 dark:bg-purple-900/30 rounded"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-12 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 dark:bg-purple-900/20 rounded-xl"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 dark:bg-purple-900/20 rounded-xl"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-16 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-5 w-24 bg-gray-200 dark:bg-purple-900/20 rounded"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-8 w-20 bg-gray-200 dark:bg-purple-900/20 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="h-3 w-12 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 dark:bg-purple-900/20 rounded-xl"></div>
                        </div>
                        <div>
                            <div class="h-3 w-12 bg-gray-300 dark:bg-purple-900/30 rounded mb-2"></div>
                            <div class="h-12 bg-gray-200 dark:bg-purple-900/20 rounded-xl"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div id="{{ $id }}-content" class="p-4 hidden max-h-[70vh] overflow-y-auto no-scrollbar dark:text-white/80"></div>

    </div>

</div>

<script>
    function bukaModal(id, url) {
        const modal  = document.getElementById(id);
        const box    = document.getElementById(id + "-box");
        const sk     = document.getElementById(id + "-skeleton");
        const cont   = document.getElementById(id + "-content");

        modal.classList.remove("hidden");
        void modal.offsetWidth;

        modal.classList.remove("opacity-0");

        box.classList.remove("scale-95");
        box.classList.add("scale-100");

        sk.classList.remove("hidden");
        cont.classList.add("hidden");
        cont.innerHTML = "";

        fetch(url)
            .then(res => res.text())
            .then(html => {
                cont.innerHTML = html;
                sk.classList.add("hidden");
                cont.classList.remove("hidden");
            })
            .catch(() => {
                cont.innerHTML = "<p class='text-red-600 dark:text-purple-400 text-center'>Gagal memuat data.</p>";
                sk.classList.add("hidden");
                cont.classList.remove("hidden");
            });
    }

    function tutupModal(id) {
        const modal = document.getElementById(id);
        const box   = document.getElementById(id + "-box");

        modal.classList.add("opacity-0");

        box.classList.remove("scale-100");
        box.classList.add("scale-95");

        setTimeout(() => {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }, 300);
}
</script>