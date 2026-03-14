<div id="confirm-delete-overlay" 
     class="fixed inset-0 bg-black/40 dark:bg-black/70 z-50 hidden opacity-0 transition-opacity duration-200">
</div>

<div id="confirm-delete-modal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center pointer-events-none">
    
    <div id="confirm-delete-content"
         class="bg-white dark:bg-black rounded-xl shadow-lg dark:shadow-purple-500/10 p-6 w-full max-w-md transform scale-95 opacity-0 
                transition-all duration-200 pointer-events-auto border dark:border-purple-500/20">

        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Konfirmasi Hapus</h2>

        <p id="deleteMessage" class="text-gray-600 dark:text-white/70 mb-6">
            
        </p>

        <div class="flex justify-end gap-2">
            <button 
                id="cancelDelete"
                class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-purple-500/20 hover:bg-gray-300 dark:hover:bg-purple-500/30 text-gray-700 dark:text-white/80 transition"
            >
                Batal
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <x-button-custom 
        label="Hapus" 
        loading="Menghapus..." 
        class="bg-red-600 hover:bg-red-700 dark:bg-purple-600 dark:hover:bg-purple-700" 
    />
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const overlay  = document.getElementById("confirm-delete-overlay");
    const modal    = document.getElementById("confirm-delete-modal");
    const content  = document.getElementById("confirm-delete-content");
    const cancel   = document.getElementById("cancelDelete");
    const form     = document.getElementById("deleteForm");
    const message  = document.getElementById("deleteMessage");

    // OPEN MODAL
    window.openDeleteModal = function(url, label, name) {
        form.action = url;

        // contoh hasil: "Apakah kamu yakin ingin menghapus kategori Baju?"
        message.textContent = `Apakah kamu yakin ingin menghapus ${label} ${name}?`;

        modal.classList.remove("hidden");
        overlay.classList.remove("hidden");

        requestAnimationFrame(() => {
            overlay.classList.remove("opacity-0");
            content.classList.remove("opacity-0", "scale-95");
            content.classList.add("opacity-100", "scale-100");
        });
    };

    // CLOSE MODAL
    function closeModal() {
        overlay.classList.add("opacity-0");
        content.classList.add("opacity-0", "scale-95");
        content.classList.remove("opacity-100", "scale-100");

        setTimeout(() => {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
        }, 200);
    }

    cancel.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
});
</script>