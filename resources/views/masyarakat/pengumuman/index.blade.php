<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Informasi Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Pengumuman Desa
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F8FAFC] py-8">

        <div class="px-4 mx-auto space-y-8 max-w-7xl sm:px-6 lg:px-8">

            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0B3D91] via-[#0B3D91] to-[#0A2540] p-6 shadow-xl sm:p-8">

                <div class="absolute w-64 h-64 rounded-full -right-20 -top-20 bg-white/10 blur-3xl"></div>

                <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-[#16A34A]/20 blur-3xl"></div>

                <div
                    class="absolute hidden w-20 h-20 border right-16 top-10 rotate-12 rounded-2xl border-white/10 bg-white/5 sm:block">
                </div>

                <div class="relative z-10 max-w-3xl">

                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-blue-100 backdrop-blur-sm">

                        <span class="h-2 w-2 rounded-full bg-[#16A34A]"></span>

                        Informasi Terkini Desa

                    </div>

                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Pengumuman Desa
                    </h1>

                    <p class="max-w-2xl mt-3 text-sm leading-6 text-blue-100 sm:text-base">
                        Temukan berbagai informasi, berita, kegiatan, dan pengumuman
                        terbaru dari desa melalui Sadesa.
                    </p>

                </div>

            </section>

            <section>

                @forelse ($pengumuman as $item)

                    @if ($loop->first)
                        <article
                            class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:border-[#2563EB]/30 hover:shadow-lg">

                            <div class="grid lg:grid-cols-5">

                                <div
                                    class="relative flex min-h-[260px] items-center justify-center overflow-hidden bg-gradient-to-br from-[#0B3D91] via-[#0A2540] to-[#0B3D91] lg:col-span-2 lg:min-h-[380px]">

                                    <div
                                        class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-[#2563EB]/30 blur-2xl">
                                    </div>

                                    <div
                                        class="absolute -bottom-16 -left-10 h-48 w-48 rounded-full bg-[#16A34A]/20 blur-2xl">
                                    </div>

                                    <div
                                        class="relative z-10 flex items-center justify-center w-24 h-24 text-white border shadow-2xl rounded-3xl border-white/10 bg-white/10 backdrop-blur-sm">

                                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 8h10M7 12h6M7 16h4" />

                                        </svg>

                                    </div>

                                    <div
                                        class="absolute bottom-5 left-5 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">
                                        Informasi Desa
                                    </div>

                                </div>

                                <div class="flex flex-col justify-between p-6 sm:p-8 lg:col-span-3">

                                    <div>

                                        <div class="flex flex-wrap items-center gap-3">

                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-[#16A34A]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#16A34A]"></span>

                                                Published

                                            </span>

                                            <span class="text-sm text-slate-400">
                                                {{ $item->published_at?->translatedFormat('d F Y') }}
                                            </span>

                                        </div>

                                        <h2
                                            class="mt-4 text-2xl font-bold leading-tight tracking-tight text-[#0A2540] transition group-hover:text-[#0B3D91] sm:text-3xl">

                                            {{ $item->judul }}

                                        </h2>

                                        <p
                                            class="mt-4 text-sm leading-7 whitespace-pre-line line-clamp-6 text-slate-600 sm:text-base">

                                            {{ $item->isi }}

                                        </p>

                                    </div>

                                    <div class="mt-7">

                                        <a class="inline-flex items-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                            href="{{ route('masyarakat.pengumuman.show', $item) }}">

                                            Baca Selengkapnya

                                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 12h14M13 6l6 6-6 6" />

                                            </svg>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </article>

                        @if ($pengumuman->count() > 1)
                            <div class="mt-8">

                                <div class="flex items-end justify-between gap-4 mb-5">

                                    <div>
                                        <p class="text-sm font-medium text-[#2563EB]">
                                            Berita & Informasi
                                        </p>

                                        <h2 class="mt-1 text-xl font-bold text-[#0A2540] sm:text-2xl">
                                            Informasi Lainnya
                                        </h2>
                                    </div>

                                </div>

                                <div class="grid gap-5 md:grid-cols-2">

                                    @foreach ($pengumuman->skip(1) as $news)
                                        <article
                                            class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#2563EB]/30 hover:shadow-md">

                                            <div
                                                class="relative flex h-40 items-center justify-center overflow-hidden bg-gradient-to-br from-[#0B3D91] to-[#0A2540]">

                                                <div
                                                    class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-[#2563EB]/20 blur-2xl">
                                                </div>

                                                <div
                                                    class="absolute -bottom-10 -left-5 h-28 w-28 rounded-full bg-[#16A34A]/20 blur-2xl">
                                                </div>

                                                <div
                                                    class="relative flex items-center justify-center text-white h-14 w-14 rounded-2xl bg-white/10 backdrop-blur-sm">

                                                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.6">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M7 8h10M7 12h6M7 16h4" />

                                                    </svg>

                                                </div>

                                            </div>

                                            <div class="flex flex-col flex-1 p-5 sm:p-6">

                                                <div class="flex items-center justify-between gap-3">

                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-[11px] font-semibold text-[#16A34A]">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#16A34A]"></span>

                                                        Published

                                                    </span>

                                                    <span class="text-xs text-slate-400">
                                                        {{ $news->published_at?->translatedFormat('d F Y') }}
                                                    </span>

                                                </div>

                                                <h3
                                                    class="mt-4 line-clamp-2 text-lg font-bold leading-snug text-[#0A2540] transition group-hover:text-[#0B3D91]">

                                                    {{ $news->judul }}

                                                </h3>

                                                <p
                                                    class="mt-3 text-sm leading-6 whitespace-pre-line line-clamp-4 text-slate-500">

                                                    {{ $news->isi }}

                                                </p>

                                                <div class="pt-5 mt-auto">

                                                    <a class="inline-flex items-center gap-2 text-sm font-semibold text-[#2563EB] transition hover:text-[#0B3D91]"
                                                        href="{{ route('masyarakat.pengumuman.show', $news) }}">

                                                        Baca detail

                                                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.8">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 12h14M13 6l6 6-6 6" />

                                                        </svg>

                                                    </a>

                                                </div>

                                            </div>

                                        </article>
                                    @endforeach

                                </div>

                            </div>
                        @endif
                    @endif

                @empty

                    <div class="p-10 text-center bg-white border shadow-sm rounded-3xl border-slate-200 sm:p-14">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-[#2563EB]">

                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M7 16h4" />

                            </svg>

                        </div>

                        <h3 class="mt-5 text-xl font-bold text-[#0A2540]">
                            Belum ada pengumuman
                        </h3>

                        <p class="max-w-md mx-auto mt-2 text-sm leading-6 text-slate-500">
                            Saat ini belum ada pengumuman publik dari desa.
                            Silakan kembali lagi untuk melihat informasi terbaru.
                        </p>

                    </div>

                @endforelse

            </section>

            @if ($pengumuman->hasPages())
                <div class="pt-2">
                    {{ $pengumuman->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
