<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Transparansi Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Transparansi Anggaran Desa
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F8FAFC] py-8">
        <div class="px-4 mx-auto space-y-8 max-w-7xl sm:px-6 lg:px-8">

            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0B3D91] via-[#0B3D91] to-[#0A2540] p-6 shadow-xl sm:p-8 lg:p-10">

                <div
                    class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-[#2563EB]/25 blur-3xl">
                </div>

                <div
                    class="pointer-events-none absolute -bottom-24 left-1/3 h-72 w-72 rounded-full bg-[#16A34A]/20 blur-3xl">
                </div>

                <div
                    class="absolute hidden w-24 h-24 border pointer-events-none right-16 top-10 rotate-12 rounded-3xl border-white/10 bg-white/5 sm:block">
                </div>

                <div class="relative z-10 max-w-3xl">

                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-blue-100 backdrop-blur-sm">

                        <span class="h-2 w-2 rounded-full bg-[#16A34A]"></span>

                        Transparansi Keuangan Desa
                    </div>

                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Transparansi Anggaran Desa
                    </h1>

                    <p class="max-w-2xl mt-3 text-sm leading-6 text-blue-100 sm:text-base">
                        Akses informasi anggaran dan keuangan desa secara terbuka
                        sebagai bentuk keterbukaan informasi publik melalui Sadesa.
                    </p>

                </div>
            </section>

            <section>
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-[#2563EB]">
                            Informasi Anggaran
                        </p>

                        <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                            Dokumen Transparansi
                        </h2>
                    </div>

                    @if ($transparansi->total() > 0)
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-[#0A2540]">
                                {{ $transparansi->total() }}
                            </span>
                            data publik
                        </p>
                    @endif

                </div>
            </section>

            <section>
                @forelse ($transparansi as $item)
                    <article
                        class="group mb-5 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:border-[#2563EB]/30 hover:shadow-lg">

                        <div class="p-5 sm:p-6 lg:p-7">

                            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                                <div class="flex-1 min-w-0">

                                    <div class="flex flex-wrap items-center gap-3">

                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-[#16A34A]">

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#16A34A]"></span>

                                            Published
                                        </span>

                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-[#2563EB]">

                                            {{ $item->periode ?? 'Periode tidak diatur' }}

                                        </span>

                                    </div>

                                    <h3
                                        class="mt-4 text-xl font-bold leading-tight tracking-tight text-[#0A2540] transition group-hover:text-[#0B3D91] sm:text-2xl">

                                        {{ $item->judul }}

                                    </h3>

                                    <p class="max-w-3xl mt-3 text-sm leading-6 text-slate-500 sm:text-base">

                                        {{ $item->deskripsi ?: 'Tidak ada deskripsi untuk dokumen ini.' }}

                                    </p>

                                </div>

                                <div class="flex flex-col gap-3 shrink-0 sm:flex-row lg:flex-col">

                                    <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-[#2563EB] hover:text-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                        href="{{ route('masyarakat.transparansi.show', $item) }}">

                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                            <circle cx="12" cy="12" r="2.75" />
                                        </svg>

                                        Lihat Detail

                                    </a>

                                    <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                        href="{{ route('masyarakat.transparansi.download', $item) }}">

                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 3v12m0 0 4-4m-4 4-4-4M4.5 21h15" />
                                        </svg>

                                        Download

                                    </a>

                                </div>

                            </div>

                        </div>

                        <div class="flex h-1">
                            <div class="w-2/3 bg-[#2563EB]"></div>
                            <div class="w-1/3 bg-[#16A34A]"></div>
                        </div>

                    </article>

                @empty

                    <div class="overflow-hidden bg-white border shadow-sm rounded-3xl border-slate-200">

                        <div class="px-6 text-center py-14 sm:px-10">

                            <div
                                class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-blue-50 text-[#2563EB]">

                                <svg class="h-9 w-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3.75h7.5L18.75 8.25v12H6.75v-16.5Z" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 3.75v4.5h4.5M9 12h6M9 15.5h6" />

                                </svg>

                            </div>

                            <h3 class="mt-5 text-xl font-bold text-[#0A2540]">
                                Belum Ada Data Anggaran
                            </h3>

                            <p class="max-w-md mx-auto mt-2 text-sm leading-6 text-slate-500">
                                Belum tersedia dokumen transparansi anggaran
                                yang dapat diakses oleh masyarakat.
                            </p>

                        </div>

                        <div class="flex h-1">
                            <div class="w-2/3 bg-[#2563EB]"></div>
                            <div class="w-1/3 bg-[#16A34A]"></div>
                        </div>

                    </div>
                @endforelse
            </section>

            @if ($transparansi->hasPages())
                <div class="pt-2">
                    {{ $transparansi->links() }}
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
