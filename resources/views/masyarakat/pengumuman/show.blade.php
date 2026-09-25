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
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">

            <article class="overflow-hidden bg-white border shadow-sm rounded-3xl border-slate-200">

                <div class="relative px-6 pt-8 pb-8 overflow-hidden sm:px-10 sm:pb-10 sm:pt-10">

                    <div
                        class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-[#2563EB]/5 blur-3xl">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-20 -left-20 h-56 w-56 rounded-full bg-[#16A34A]/5 blur-3xl">
                    </div>

                    <div class="relative">

                        <div class="flex flex-wrap items-center gap-3">

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-[#16A34A]">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#16A34A]"></span>

                                Publikasi Resmi
                            </span>

                            <span class="text-sm text-slate-400">
                                {{ $pengumuman->published_at?->translatedFormat('d F Y') }}
                            </span>

                        </div>

                        <h1
                            class="mt-5 max-w-4xl text-3xl font-bold leading-tight tracking-tight text-[#0A2540] sm:text-4xl lg:text-5xl">
                            {{ $pengumuman->judul }}
                        </h1>

                        <div class="flex items-center gap-2 mt-6">
                            <div class="h-1 w-16 rounded-full bg-[#2563EB]"></div>
                            <div class="h-1 w-8 rounded-full bg-[#16A34A]"></div>
                        </div>

                    </div>
                </div>

                <div class="border-t border-slate-100">
                    <div class="px-6 py-8 sm:px-10 sm:py-10 lg:px-14">

                        <div
                            class="article-content max-w-none whitespace-pre-line text-[15px] leading-8 text-slate-700 sm:text-base sm:leading-8">

                            {{ $pengumuman->isi }}

                        </div>

                    </div>
                </div>

                <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/70 sm:px-10">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div class="shrink-0">

                            <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                href="{{ route('masyarakat.pengumuman.index') }}">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />

                                </svg>

                                Kembali ke Pengumuman

                            </a>

                        </div>

                        <div class="flex items-start gap-3 sm:flex-row-reverse sm:text-right">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#0B3D91]/10 text-[#0B3D91]">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3.75l7.5 3.375v5.625c0 4.5-3.15 7.65-7.5 8.625-4.35-.975-7.5-4.125-7.5-8.625V7.125L12 3.75z" />

                                </svg>

                            </div>

                            <div class="min-w-0">

                                <div class="flex items-center gap-2 sm:justify-end">

                                    <span class="h-1.5 w-1.5 rounded-full bg-[#16A34A]">
                                    </span>

                                    <p class="text-sm font-bold text-[#0A2540]">
                                        Informasi Resmi Desa
                                    </p>

                                </div>

                                <p class="max-w-md mt-1 text-xs leading-5 text-slate-500">
                                    Diterbitkan dan dikelola secara resmi oleh
                                    <span class="font-semibold text-slate-600">
                                        Tim Sadesa
                                    </span>
                                    sebagai media informasi desa.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </article>

        </div>
    </div>

</x-app-layout>
