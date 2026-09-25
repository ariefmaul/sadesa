<div class="pointer-events-none fixed inset-0 z-[9999] hidden items-center justify-center bg-[#0A2540]/30 backdrop-blur-[3px]"
    id="crud-loader" aria-hidden="true">
    <div
        class="mx-4 flex min-w-[180px] flex-col items-center rounded-2xl border border-white/20 bg-white px-7 py-6 shadow-2xl">

        {{-- 3 BAR --}}
        <div class="flex h-10 items-end justify-center gap-1.5">

            <span class="crud-loader-bar h-4 w-1.5 rounded-full bg-[#0A2540]"></span>

            <span class="crud-loader-bar h-7 w-1.5 rounded-full bg-[#2563EB]"></span>

            <span class="crud-loader-bar h-10 w-1.5 rounded-full bg-[#22C55E]"></span>

        </div>

        {{-- TEXT --}}
        <p class="mt-4 text-sm font-semibold text-[#0A2540]" id="crud-loader-text">
            Loading...
        </p>

    </div>
</div>

<style>
    .crud-loader-bar {
        transform-origin: bottom;
        animation: crudLoaderBounce 0.9s ease-in-out infinite;
    }

    .crud-loader-bar:nth-child(1) {
        animation-delay: 0s;
    }

    .crud-loader-bar:nth-child(2) {
        animation-delay: 0.15s;
    }

    .crud-loader-bar:nth-child(3) {
        animation-delay: 0.30s;
    }

    @keyframes crudLoaderBounce {

        0%,
        100% {
            transform: scaleY(0.45);
            opacity: 0.55;
        }

        50% {
            transform: scaleY(1);
            opacity: 1;
        }
    }

    #crud-loader.crud-loader-show {
        display: flex;
        pointer-events: auto;
    }

    body.crud-loading {
        overflow: hidden;
    }
</style>

<script>
    (() => {

        const loader = document.getElementById('crud-loader');
        const loaderText = document.getElementById('crud-loader-text');

        if (!loader) return;


        /**
         * Tampilkan loader
         */
        window.showCrudLoader = function(text = 'Memproses...') {

            if (loaderText) {
                loaderText.textContent = text;
            }

            loader.classList.remove('hidden');
            loader.classList.add('crud-loader-show');

            loader.setAttribute('aria-hidden', 'false');

            document.body.classList.add('crud-loading');
        };


        /**
         * Sembunyikan loader
         */
        window.hideCrudLoader = function() {

            loader.classList.remove('crud-loader-show');

            loader.classList.add('hidden');

            loader.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('crud-loading');
        };


        /**
         * FORM SUBMIT
         *
         * Otomatis aktif untuk semua form.
         */
        document.addEventListener('submit', function(event) {

            const form = event.target;

            if (!(form instanceof HTMLFormElement)) {
                return;
            }

            // Jangan tampilkan loader untuk form yang ditandai skip
            if (form.dataset.noLoader !== undefined) {
                return;
            }

            let text = 'Memproses...';

            const method = (
                form.getAttribute('method') || 'GET'
            ).toUpperCase();

            if (method === 'POST') {
                text = 'Menyimpan...';
            }

            if (method === 'PUT' || method === 'PATCH') {
                text = 'Memperbarui...';
            }

            if (method === 'DELETE') {
                text = 'Menghapus...';
            }

            showCrudLoader(text);

        });


        /**
         * LINK / BUTTON ACTION
         *
         * Otomatis aktif ketika klik link yang mengarah
         * ke halaman CRUD.
         */
        document.addEventListener('click', function(event) {

            const link = event.target.closest('a');

            if (!link) return;

            if (link.dataset.noLoader !== undefined) {
                return;
            }

            const href = link.getAttribute('href');

            if (!href || href === '#') {
                return;
            }

            // Jangan loader untuk:
            // anchor section
            if (href.startsWith('#')) {
                return;
            }

            // Jangan loader untuk:
            // javascript
            if (href.startsWith('javascript:')) {
                return;
            }

            // Jangan loader untuk:
            // target baru
            if (link.target === '_blank') {
                return;
            }

            // Jangan loader untuk:
            // modifier click
            if (
                event.ctrlKey ||
                event.metaKey ||
                event.shiftKey ||
                event.altKey
            ) {
                return;
            }

            showCrudLoader('Memuat...');

        });


        /**
         * BACK / FORWARD BROWSER
         */
        window.addEventListener('pageshow', function() {
            hideCrudLoader();
        });


        /**
         * Jika halaman selesai dimuat
         */
        window.addEventListener('load', function() {
            hideCrudLoader();
        });

    })();
</script>
