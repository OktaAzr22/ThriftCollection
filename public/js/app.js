        function openModal(id) {
            const modal = document.getElementById(id);
            const card = modal.querySelector('.bg-white');

            modal.classList.remove('hidden');
            void modal.offsetWidth; 
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

                clearFormErrors(id);
                resetForm(id);
                
            }, 300);
        }

        function resetForm(modalId) {
            const modal = document.getElementById(modalId);
            const form = modal.querySelector("form");
            
            if (form) {
                form.reset(); 
            }
        }

        function clearFormErrors(modalId) {
            const modal = document.getElementById(modalId);
            
            modal.querySelectorAll('.text-red-500').forEach(el => el.remove());
            
            modal.querySelectorAll('.border-red-500').forEach(el => {
                el.classList.remove('border-red-500');
            });
        }

        document.addEventListener('click', (e) => {
            if (e.target.closest('.closeModal')) {
                const closeBtn = e.target.closest('.closeModal');
                closeModal(closeBtn.dataset.id);
            }
            
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

        document.addEventListener("click", function (e) {
            let button = e.target.closest(".button-custom");
            if (!button) return;

            if (button.disabled) return;

            let form = button.closest("form");
            if (!form) return;

            let loadingText = button.getAttribute("data-loading");

            let spinner = button.querySelector(".spinner");
            let text = button.querySelector(".button-text");

            spinner.classList.remove("hidden");
            text.textContent = loadingText;

            button.disabled = true;

            setTimeout(() => {
                form.submit();
            }, 120);
        });  