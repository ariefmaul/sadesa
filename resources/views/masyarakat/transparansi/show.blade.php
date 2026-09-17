<x-app-layout>

    
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Transparansi Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Detail Transparansi Anggaran
            </h2>
        </div>
    </x-slot>


    
    <div class="min-h-screen bg-[#F8FAFC] py-8">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


            
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                
                
                

                <div
                    class="relative overflow-hidden bg-gradient-to-br from-[#0B3D91] via-[#0B3D91] to-[#0A2540] px-6 py-8 sm:px-10 sm:py-10">

                    
                    <div
                        class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[#2563EB]/25 blur-3xl">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-24 left-1/3 h-72 w-72 rounded-full bg-[#16A34A]/20 blur-3xl">
                    </div>

                    <div
                        class="pointer-events-none absolute right-12 top-12 hidden h-20 w-20 rotate-12 rounded-2xl border border-white/10 bg-white/5 sm:block">
                    </div>


                    <div class="relative z-10">

                        
                        <div class="flex flex-wrap items-center gap-3">

                            
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">

                                <span class="h-2 w-2 rounded-full bg-[#16A34A]"></span>

                                Published

                            </span>


                            
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-medium text-blue-100 backdrop-blur-sm">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3.75v3m10.5-3v3M4.5 9.75h15M5.25 5.25h13.5A1.75 1.75 0 0120.5 7v11.75a1.75 1.75 0 01-1.75 1.75H5.25v-16.5Z" />

                                </svg>

                                {{ $transparansi->periode ?? 'Periode tidak diatur' }}

                            </span>

                        </div>


                        
                        <h1
                            class="mt-5 max-w-4xl text-3xl font-bold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">

                            {{ $transparansi->judul }}

                        </h1>


                        
                        <div class="mt-6 flex items-center gap-2">

                            <div class="h-1 w-16 rounded-full bg-[#2563EB]"></div>

                            <div class="h-1 w-8 rounded-full bg-[#16A34A]"></div>

                        </div>


                        
                        <p class="mt-5 max-w-2xl text-sm leading-6 text-blue-100 sm:text-base">

                            Informasi transparansi anggaran desa yang dapat
                            diakses secara terbuka oleh masyarakat melalui
                            sistem Sadesa.

                        </p>

                    </div>

                </div>


                
                
                

                <div class="px-6 py-8 sm:px-10 sm:py-10 lg:px-14">


                    
                    <div class="grid gap-4 sm:grid-cols-2">


                        
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3.75v3m10.5-3v3M4.5 9.75h15M5.25 5.25h13.5A1.75 1.75 0 0120.5 7v11.75a1.75 1.75 0 01-1.75 1.75H5.25V7A1.75 1.75 0 015.25 5.25Z" />

                                    </svg>

                                </div>


                                <div>

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Periode Anggaran
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-[#0A2540]">
                                        {{ $transparansi->periode ?? 'Tidak diatur' }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-[#16A34A]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75l2 2 4-4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0Z" />

                                    </svg>

                                </div>


                                <div>

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Status Publikasi
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-[#16A34A]">
                                        Dipublikasikan
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    
                    
                    

                    <div class="mt-10">

                        <div class="mb-5">

                            <p class="text-sm font-medium text-[#2563EB]">
                                Informasi Dokumen
                            </p>

                            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                                Ringkasan Transparansi
                            </h2>

                        </div>


                        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8">

                            <div class="flex gap-4">

                                
                                <div
                                    class="hidden w-1 shrink-0 rounded-full bg-gradient-to-b from-[#2563EB] to-[#16A34A] sm:block">
                                </div>


                                
                                <p class="whitespace-pre-line text-[15px] leading-8 text-slate-600 sm:text-base">

                                    {{ $transparansi->deskripsi ?: 'Tidak ada deskripsi untuk dokumen transparansi ini.' }}

                                </p>

                            </div>

                        </div>

                    </div>


                    
                    
                    

                    <div class="mt-8">

                        <div class="relative overflow-hidden rounded-2xl bg-[#0A2540] p-6 sm:p-7">

                            
                            <div
                                class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#2563EB]/20 blur-2xl">
                            </div>

                            <div
                                class="pointer-events-none absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#16A34A]/20 blur-2xl">
                            </div>


                            <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">


                                
                                <div class="flex items-start gap-4">

                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 text-white">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3.75h7.5L18.75 8.25v12H6.75v-16.5Z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.25 3.75v4.5h4.5M9 12h6M9 15.5h4" />

                                        </svg>

                                    </div>


                                    <div>

                                        <p class="text-sm font-bold text-white">
                                            Dokumen Transparansi Anggaran
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-blue-100">
                                            Unduh dokumen lengkap transparansi
                                            anggaran desa untuk melihat informasi
                                            secara lebih rinci.
                                        </p>

                                    </div>

                                </div>


                                
                                <a href="{{ route('masyarakat.transparansi.download', $transparansi) }}"
                                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-[#0B3D91] shadow-sm transition duration-200 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0A2540]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v12m0 0 4-4m-4 4-4-4M4.5 21h15" />

                                    </svg>

                                    Download Dokumen

                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                
                
                

                <div class="border-t border-slate-100 bg-slate-50/70 px-6 py-6 sm:px-10">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">


                        
                        <div class="shrink-0">

                            <a href="{{ route('masyarakat.transparansi.index') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />

                                </svg>

                                Kembali ke Transparansi

                            </a>

                        </div>


                        
                        <div class="flex items-start gap-3 sm:flex-row-reverse sm:text-right">


                            
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#0B3D91]/10 text-[#0B3D91]">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
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


                                <p class="mt-1 max-w-md text-xs leading-5 text-slate-500">

                                    Informasi transparansi anggaran yang
                                    dipublikasikan secara resmi melalui

                                    <span class="font-semibold text-slate-600">
                                        Sadesa
                                    </span>

                                    sebagai bentuk keterbukaan informasi publik.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="flex h-1">

                    <div class="w-2/3 bg-[#2563EB]"></div>

                    <div class="w-1/3 bg-[#16A34A]"></div>

                </div>


            </article>

        </div>

    </div>

</x-app-layout>
