<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (Auth::user()->role === 'super_admin')
                        <x-nav-link :href="route('admin.provinsi.index')" :active="request()->routeIs('admin.provinsi.*')">
                            {{ __('Provinsi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kota.index')" :active="request()->routeIs('admin.kota.*')">
                            {{ __('Kota / Kabupaten') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kecamatan.index')" :active="request()->routeIs('admin.kecamatan.*')">
                            {{ __('Kecamatan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.desa.index')" :active="request()->routeIs('admin.desa.*')">
                            {{ __('Desa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.admin-desa.index')" :active="request()->routeIs('admin.admin-desa.*')">
                            {{ __('Admin Desa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.template-surat.index')" :active="request()->routeIs('admin.template-surat.*')">
                            {{ __('Template Surat') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->role === 'admin_desa')
                        <x-nav-link :href="route('admin.masyarakat.index')" :active="request()->routeIs('admin.masyarakat.*')">
                            {{ __('Verifikasi Masyarakat') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.pengajuan.index')" :active="request()->routeIs('admin.pengajuan.*')">
                            {{ __('Pengajuan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.template-surat.index')" :active="request()->routeIs('admin.template-surat.*')">
                            {{ __('Template Surat') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.pengumuman.index')" :active="request()->routeIs('admin.pengumuman.*')">
                            {{ __('Pengumuman Desa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.transparansi.index')" :active="request()->routeIs('admin.transparansi.*')">
                            {{ __('Transparansi Anggaran') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->role === 'masyarakat')
                        <x-nav-link :href="route('masyarakat.pengajuan.index')" :active="request()->routeIs('masyarakat.pengajuan.index')">
                            {{ __('Pengajuan Surat') }}
                        </x-nav-link>
                        <x-nav-link :href="route('masyarakat.pengajuan.riwayat')" :active="request()->routeIs('masyarakat.pengajuan.riwayat')">
                            {{ __('Riwayat Pengajuan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('masyarakat.pengumuman.index')" :active="request()->routeIs('masyarakat.pengumuman.*')">
                            {{ __('Pengumuman Desa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('masyarakat.transparansi.index')" :active="request()->routeIs('masyarakat.transparansi.*')">
                            {{ __('Transparansi Anggaran') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::user()->role === 'admin_desa')
                    <div class="relative mr-4" x-data="{ open: false }">
                        <button type="button" @click="open = !open"
                            class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                            <span class="text-2xl">🔔</span>
                            <span id="notification-badge"
                                class="absolute -right-1 -top-1 hidden min-w-5 rounded-full bg-red-600 px-1 text-center text-[10px] font-bold text-white">0</span>
                        </button>

                        <div x-show="open" x-transition @click.outside="open = false"
                            class="absolute right-0 mt-2 w-80 rounded-lg border border-gray-200 bg-white shadow-lg"
                            style="display: none;">
                            <div class="border-b border-gray-200 px-4 py-3 text-sm font-semibold text-gray-800">
                                Notifikasi</div>
                            <div id="notification-list" class="max-h-80 overflow-y-auto">
                                <div class="px-4 py-3 text-sm text-gray-500">Tidak ada notifikasi baru.</div>
                            </div>
                        </div>
                    </div>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->role === 'admin_desa')
                <div class="px-4 py-2">
                    <button type="button" id="mobile-notification-toggle"
                        class="inline-flex items-center gap-2 rounded-md border border-gray-200 px-3 py-2 text-sm font-medium text-gray-700">
                        <span>🔔</span>
                        <span>Notifikasi</span>
                        <span id="mobile-notification-badge"
                            class="hidden rounded-full bg-red-600 px-1.5 py-0.5 text-[10px] font-bold text-white">0</span>
                    </button>
                </div>
                <div id="mobile-notification-list" class="hidden px-4 pb-3">
                    <div class="rounded-md border border-gray-200 bg-white p-3 text-sm text-gray-500">Tidak ada
                        notifikasi baru.</div>
                </div>
            @endif
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if (Auth::user()->role === 'super_admin')
                <x-responsive-nav-link :href="route('admin.desa.index')" :active="request()->routeIs('admin.desa.*')">
                    {{ __('Desa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.provinsi.index')" :active="request()->routeIs('admin.provinsi.*')">
                    {{ __('Provinsi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kota.index')" :active="request()->routeIs('admin.kota.*')">
                    {{ __('Kota / Kabupaten') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kecamatan.index')" :active="request()->routeIs('admin.kecamatan.*')">
                    {{ __('Kecamatan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.admin-desa.index')" :active="request()->routeIs('admin.admin-desa.*')">
                    {{ __('Admin Desa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.template-surat.index')" :active="request()->routeIs('admin.template-surat.*')">
                    {{ __('Template Surat') }}
                </x-responsive-nav-link>
            @endif
            @if (Auth::user()->role === 'admin_desa')
                <x-responsive-nav-link :href="route('admin.masyarakat.index')" :active="request()->routeIs('admin.masyarakat.*')">
                    {{ __('Verifikasi Masyarakat') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pengajuan.index')" :active="request()->routeIs('admin.pengajuan.*')">
                    {{ __('Pengajuan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.template-surat.index')" :active="request()->routeIs('admin.template-surat.*')">
                    {{ __('Template Surat') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pengumuman.index')" :active="request()->routeIs('admin.pengumuman.*')">
                    {{ __('Pengumuman Desa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.transparansi.index')" :active="request()->routeIs('admin.transparansi.*')">
                    {{ __('Transparansi Anggaran') }}
                </x-responsive-nav-link>
            @endif
            @if (Auth::user()->role === 'masyarakat')
                <x-responsive-nav-link :href="route('masyarakat.pengajuan.index')" :active="request()->routeIs('masyarakat.pengajuan.index')">
                    {{ __('Pengajuan Surat') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('masyarakat.pengajuan.riwayat')" :active="request()->routeIs('masyarakat.pengajuan.riwayat')">
                    {{ __('Riwayat Pengajuan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('masyarakat.pengumuman.index')" :active="request()->routeIs('masyarakat.pengumuman.*')">
                    {{ __('Pengumuman Desa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('masyarakat.transparansi.index')" :active="request()->routeIs('masyarakat.transparansi.*')">
                    {{ __('Transparansi Anggaran') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    @if (Auth::user()->role === 'admin_desa')
        <script>
            (function() {
                const badge = document.getElementById('notification-badge');
                const list = document.getElementById('notification-list');
                const mobileBadge = document.getElementById('mobile-notification-badge');
                const mobileList = document.getElementById('mobile-notification-list');
                const mobileToggle = document.getElementById('mobile-notification-toggle');

                async function loadNotifications() {
                    try {
                        const response = await fetch('{{ route('admin.pengajuan.notifications') }}');
                        const data = await response.json();
                        const items = data.items || [];
                        const count = Number(data.count || 0);

                        const renderItem = (item) => `
                            <a href="${item.route}" data-id="${item.id}" class="block border-b border-gray-100 px-4 py-3 text-sm hover:bg-gray-50 ${item.read_at ? 'opacity-70' : ''}">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">${item.title}</p>
                                        <p class="mt-1 text-gray-600">${item.message}</p>
                                        <p class="mt-1 text-xs text-gray-400">${item.created_at}</p>
                                    </div>
                                    ${item.read_at ? '' : '<span class="mt-1 h-2.5 w-2.5 rounded-full bg-red-500"></span>'}
                                </div>
                            </a>
                        `;

                        if (list) {
                            if (!items.length) {
                                list.innerHTML =
                                    '<div class="px-4 py-3 text-sm text-gray-500">Tidak ada notifikasi baru.</div>';
                            } else {
                                list.innerHTML = items.map(renderItem).join('');
                                list.querySelectorAll('a[data-id]').forEach((link) => {
                                    link.addEventListener('click', async function() {
                                        const id = this.getAttribute('data-id');
                                        if (!id) return;
                                        await fetch(
                                            `{{ route('admin.pengajuan.notifications.read', ['id' => '__ID__']) }}`
                                            .replace('__ID__', id), {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json'
                                                }
                                            });
                                    });
                                });
                            }
                        }

                        if (mobileList) {
                            if (!items.length) {
                                mobileList.innerHTML =
                                    '<div class="rounded-md border border-gray-200 bg-white p-3 text-sm text-gray-500">Tidak ada notifikasi baru.</div>';
                            } else {
                                mobileList.innerHTML = items.map((item) => `
                                    <a href="${item.route}" data-id="${item.id}" class="block rounded-md border border-gray-200 bg-white p-3 text-sm text-gray-700 ${item.read_at ? 'opacity-70' : ''}">
                                        <div class="font-semibold">${item.title}</div>
                                        <div class="mt-1 text-gray-600">${item.message}</div>
                                        <div class="mt-1 text-xs text-gray-400">${item.created_at}</div>
                                    </a>
                                `).join('');
                            }
                        }

                        const badgeContent = count > 0 ? count : 0;
                        if (badge) {
                            badge.textContent = badgeContent;
                            badge.classList.toggle('hidden', count === 0);
                        }
                        if (mobileBadge) {
                            mobileBadge.textContent = badgeContent;
                            mobileBadge.classList.toggle('hidden', count === 0);
                        }
                    } catch (error) {
                        console.error('Notif load failed:', error);
                    }
                }

                if (mobileToggle && mobileList) {
                    mobileToggle.addEventListener('click', function() {
                        mobileList.classList.toggle('hidden');
                    });
                }

                loadNotifications();
                setInterval(loadNotifications, 15000);
            })();
        </script>
    @endif
</nav>
