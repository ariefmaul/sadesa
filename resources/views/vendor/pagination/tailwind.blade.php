@if ($paginator->hasPages())

    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="w-full">

        {{-- =========================================================
            MOBILE PAGINATION
        ========================================================== --}}
        <div class="flex items-center justify-between gap-3 sm:hidden">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center gap-2 rounded-lg
                           border border-slate-200
                           bg-slate-100
                           px-4 py-2
                           text-sm font-semibold
                           text-slate-400
                           cursor-not-allowed">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                    </svg>

                    Sebelumnya

                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center gap-2 rounded-lg
                           border border-slate-200
                           bg-white
                           px-4 py-2
                           text-sm font-semibold
                           text-[#0A2540]
                           shadow-sm
                           transition-all duration-200
                           hover:-translate-x-0.5
                           hover:border-[#2563EB]
                           hover:bg-blue-50
                           hover:text-[#2563EB]
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#2563EB]/20">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                    </svg>

                    Sebelumnya

                </a>
            @endif


            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center gap-2 rounded-lg
                           border border-slate-200
                           bg-white
                           px-4 py-2
                           text-sm font-semibold
                           text-[#0A2540]
                           shadow-sm
                           transition-all duration-200
                           hover:translate-x-0.5
                           hover:border-[#2563EB]
                           hover:bg-blue-50
                           hover:text-[#2563EB]
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#2563EB]/20">

                    Selanjutnya

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                    </svg>

                </a>
            @else
                <span
                    class="inline-flex items-center gap-2 rounded-lg
                           border border-slate-200
                           bg-slate-100
                           px-4 py-2
                           text-sm font-semibold
                           text-slate-400
                           cursor-not-allowed">

                    Selanjutnya

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                    </svg>

                </span>
            @endif

        </div>


        {{-- =========================================================
            DESKTOP PAGINATION
        ========================================================== --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between sm:gap-6">

            {{-- =====================================================
                DATA INFORMATION
            ====================================================== --}}
            <div>

                <p class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-[#0A2540]">
                        {{ $paginator->firstItem() ?? 0 }}
                    </span>

                    sampai

                    <span class="font-semibold text-[#0A2540]">
                        {{ $paginator->lastItem() ?? 0 }}
                    </span>

                    dari

                    <span class="font-semibold text-[#0A2540]">
                        {{ $paginator->total() }}
                    </span>

                    data

                </p>

            </div>


            {{-- =====================================================
                PAGINATION CONTROL
            ====================================================== --}}
            <div class="flex items-center gap-1.5">

                {{-- =================================================
                    PREVIOUS BUTTON
                ================================================== --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex h-9 w-9 items-center justify-center
                               rounded-lg
                               border border-slate-200
                               bg-slate-100
                               text-slate-300
                               cursor-not-allowed">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                        </svg>

                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex h-9 w-9 items-center justify-center
                               rounded-lg
                               border border-slate-200
                               bg-white
                               text-[#0A2540]
                               shadow-sm
                               transition-all duration-200
                               hover:-translate-x-0.5
                               hover:border-[#2563EB]
                               hover:bg-blue-50
                               hover:text-[#2563EB]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#2563EB]/20">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                        </svg>

                    </a>
                @endif


                {{-- =================================================
                    PAGE NUMBER LOGIC
                ================================================== --}}
                @php

                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();

                    $pages = [];

                    /*
                    |--------------------------------------------------------------------------
                    | <= 7 halaman
                    |--------------------------------------------------------------------------
                    */

                    if ($last <= 7) {
                        $pages = range(1, $last);
                    }
                    /*
                    |--------------------------------------------------------------------------
                    | Halaman awal
                    |--------------------------------------------------------------------------
                    | Contoh:
                    | 1 2 3 4 5 ... 51 52
                    |--------------------------------------------------------------------------
                    */ elseif (
                        $current <= 4
                    ) {
                        $pages = [1, 2, 3, 4, 5, '...', $last - 1, $last];
                    }
                    /*
                    |--------------------------------------------------------------------------
                    | Halaman akhir
                    |--------------------------------------------------------------------------
                    | Contoh:
                    | 1 2 ... 48 49 50 51 52
                    |--------------------------------------------------------------------------
                    */ elseif (
                        $current >=
                        $last - 3
                    ) {
                        $pages = [1, 2, '...', $last - 4, $last - 3, $last - 2, $last - 1, $last];
                    }
                    /*
                    |--------------------------------------------------------------------------
                    | Halaman tengah
                    |--------------------------------------------------------------------------
                    | Contoh:
                    | 1 2 ... 24 25 26 ... 51 52
                    |--------------------------------------------------------------------------
                    */ else {
                        $pages = [1, 2, '...', $current - 1, $current, $current + 1, '...', $last - 1, $last];
                    }

                @endphp


                {{-- =================================================
                    PAGE NUMBERS
                ================================================== --}}
                @foreach ($pages as $page)
                    {{-- =================================================
                        ELLIPSIS
                    ================================================== --}}
                    @if ($page === '...')
                        <span aria-hidden="true"
                            class="inline-flex h-9 min-w-8
                                   items-center justify-center
                                   px-1
                                   text-sm font-semibold
                                   text-slate-400">

                            ...

                        </span>


                        {{-- =================================================
                        CURRENT PAGE
                    ================================================== --}}
                    @elseif ($page == $current)
                        <span aria-current="page"
                            class="inline-flex h-9 min-w-9
                                   items-center justify-center
                                   rounded-lg
                                   bg-[#0A2540]
                                   px-3
                                   text-sm font-bold
                                   text-white
                                   shadow-sm
                                   ring-1 ring-[#0A2540]/10">

                            {{ $page }}

                        </span>


                        {{-- =================================================
                        OTHER PAGE
                    ================================================== --}}
                    @else
                        <a href="{{ $paginator->url($page) }}"
                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                            class="inline-flex h-9 min-w-9
                                   items-center justify-center
                                   rounded-lg
                                   border border-transparent
                                   bg-white
                                   px-3
                                   text-sm font-semibold
                                   text-slate-600
                                   transition-all duration-200
                                   hover:-translate-y-0.5
                                   hover:border-[#2563EB]/30
                                   hover:bg-blue-50
                                   hover:text-[#2563EB]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#2563EB]/20">

                            {{ $page }}

                        </a>
                    @endif
                @endforeach


                {{-- =================================================
                    NEXT BUTTON
                ================================================== --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}"
                        class="inline-flex h-9 w-9 items-center justify-center
                               rounded-lg
                               border border-slate-200
                               bg-white
                               text-[#0A2540]
                               shadow-sm
                               transition-all duration-200
                               hover:translate-x-0.5
                               hover:border-[#2563EB]
                               hover:bg-blue-50
                               hover:text-[#2563EB]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#2563EB]/20">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                        </svg>

                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                        class="inline-flex h-9 w-9 items-center justify-center
                               rounded-lg
                               border border-slate-200
                               bg-slate-100
                               text-slate-300
                               cursor-not-allowed">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                        </svg>

                    </span>
                @endif

            </div>

        </div>

    </nav>

@endif
