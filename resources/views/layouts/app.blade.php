<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thriftting - Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3056D3',
                        secondary: '#13C296',
                        dark: '#212B36',
                        light: '#F4F7FF'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-in-right': 'slideInRight 0.3s ease-out',
                        'slide-out-right': 'slideOutRight 0.3s ease-in'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        slideOutRight: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(100%)' }
                        }
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50">
  @include('components.alert')
  @include('partials.header')
  @include('partials.sidebar')
  <x-confirm-delete />
    

    

   

    @stack('scripts')
    <script>
    function openModal(id) {
    const modal = document.getElementById(id);
    const card = modal.querySelector('.bg-white');

    modal.classList.remove('hidden');
    void modal.offsetWidth; // Trigger reflow
    modal.classList.remove('opacity-0');
    
    card.classList.remove('scale-95');
    card.classList.add('scale-100');

    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const modal = document.getElementById(id);
    const card = modal.querySelector('.bg-white');

    modal.classList.add('opacity-0');
    card.classList.remove('scale-100');
    card.classList.add('scale-95');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Clear errors dan reset form
        clearFormErrors(id);
        resetForm(id);
        
    }, 300);
}

// Fungsi khusus untuk reset form
function resetForm(modalId) {
    const modal = document.getElementById(modalId);
    const form = modal.querySelector("form");
    
    if (form) {
        form.reset(); // Ini sudah cukup untuk reset semua input
    }
}

// Fungsi clear errors (tetap sama)
function clearFormErrors(modalId) {
    const modal = document.getElementById(modalId);
    
    // Hapus pesan error
    modal.querySelectorAll('.text-red-500').forEach(el => el.remove());
    
    // Hapus border merah
    modal.querySelectorAll('.border-red-500').forEach(el => {
        el.classList.remove('border-red-500');
    });
}

// Event Listeners yang Lebih Spesifik
document.addEventListener('click', (e) => {
    // Handle close button
    if (e.target.closest('.closeModal')) {
        const closeBtn = e.target.closest('.closeModal');
        closeModal(closeBtn.dataset.id);
    }
    
    // Handle klik di luar modal (overlay)
    if (e.target.classList.contains('fixed') && 
        e.target.classList.contains('inset-0') && 
        e.target.classList.contains('bg-black')) {
        const modals = document.querySelectorAll('.fixed.inset-0.bg-black');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                closeModal(modal.id);
            }
        });
    }
});

// Juga handle tombol "Batal" secara spesifik
document.addEventListener('click', (e) => {
    if (e.target.type === 'button' && e.target.textContent.trim() === 'Batal') {
        const modal = e.target.closest('.fixed.inset-0');
        if (modal) {
            closeModal(modal.id);
        }
    }
});

   

    function previewEditImage(event, id) {
    const file = event.target.files[0];
    const previewArea = document.getElementById(`previewAreaEdit-${id}`);
    const deleteBtn = document.getElementById(`deleteImageBtnEdit-${id}`);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewArea.innerHTML = `
                <img src="${e.target.result}" class="h-32 rounded-lg mx-auto object-cover mb-3">
            `;
        };
        reader.readAsDataURL(file);

        deleteBtn.classList.remove("hidden");
    }
}

/* HAPUS GAMBAR EDIT */
function clearEditImage(id) {
    const input = document.getElementById(`imageEdit-${id}`);
    const previewArea = document.getElementById(`previewAreaEdit-${id}`);
    const deleteBtn = document.getElementById(`deleteImageBtnEdit-${id}`);

    input.value = "";
    previewArea.innerHTML = `
        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
        <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
        <p class="text-xs text-gray-400 mt-1">Format JPG/PNG max 2MB</p>
    `;

    deleteBtn.classList.add("hidden");
}

function previewImage(event) {
    const input = event.target;
    const previewArea = document.getElementById('previewArea');
    const deleteBtn = document.getElementById('deleteImageBtn');
    const uploadArea = document.getElementById('uploadArea');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewArea.innerHTML = `
                <img src="${e.target.result}"
                     class="h-32 rounded-lg mx-auto object-cover mb-3">
            `;
        };

        reader.readAsDataURL(input.files[0]);

        deleteBtn.classList.remove('hidden', 'opacity-0');
        uploadArea.classList.add('border-primary');
    }
}

function clearImage() {
    const input = document.getElementById('image');
    const previewArea = document.getElementById('previewArea');
    const deleteBtn = document.getElementById('deleteImageBtn');

    input.value = "";
    
    previewArea.innerHTML = `
        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
        <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF (Maks. 5MB)</p>
    `;

    deleteBtn.classList.add('hidden');
}
</script>

</body>
</html>