@props([
    'active' => false,
    'icon' => 'home',
    'collapsed' => false,
])

@php
    $icons = [
        'home' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 10.5L12 3l9 7.5M5.25 9.75V21h13.5V9.75M9 21v-6h6v6" />
        ',

        'map' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 18l-6 3V6l6-3m0 15l6 3m-6-3V3m6 18l6-3V3l-6 3m0 15V6" />
        ',

        'building' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 21h18M6 21V5.25A2.25 2.25 0 018.25 3h7.5A2.25 2.25 0 0118 5.25V21M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1M10 21v-3h4v3" />
        ',

        'location' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21s7-5.25 7-11a7 7 0 10-14 0c0 5.75 7 11 7 11z" />
            <circle cx="12" cy="10" r="2.5" />
        ',

        'users' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
        ',

        'document' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6 3h8l4 4v14H6V3zM14 3v5h5M9 13h6M9 17h6" />
        ',

        'template' => '
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 8h8M8 12h8M8 16h5" />
        ',

        'megaphone' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 11l15-5v12L3 13v-2zM18 10h2a2 2 0 012 2v1a2 2 0 01-2 2h-2M6 14l1 5" />
        ',

        'chart' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 19V5M4 19h16M8 16v-5M12 16V7M16 16v-8" />
        ',

        'history' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 12a9 9 0 109-9c-2.5 0-4.8 1-6.36 2.64L3 8.5M3 4v4.5h4.5M12 7v5l3 2" />
        ',

        'scan' => '
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 12h10" />
        ',
    ];

    $iconSvg = $icons[$icon] ?? $icons['home'];
@endphp

<a
    {{ $attributes->merge([
        'class' =>
            'group relative mb-1 flex items-center rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 ' .
            ($active
                ? 'bg-white text-[#0A2540] shadow-lg shadow-black/10'
                : 'text-blue-100 hover:bg-white/10 hover:text-white'),
    ]) }}>

    {{-- Active Indicator --}}
    @if ($active)
        <span class="absolute -left-3 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#3B82F6]"></span>
    @endif

    {{-- Icon --}}
    <span
        class="{{ $active
            ? 'bg-blue-50 text-[#2563EB]'
            : 'bg-white/5 text-blue-200 group-hover:bg-white/10 group-hover:text-white' }} flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition duration-200">

        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.7">
            {!! $iconSvg !!}
        </svg>

    </span>

    {{-- Label --}}
    <span class="ml-3 truncate" x-show="!collapsed" x-transition.opacity>
        {{ $slot }}
    </span>

    {{-- Tooltip when collapsed --}}
    <span
        class="pointer-events-none absolute left-[68px] z-[100] hidden whitespace-nowrap rounded-lg bg-[#0A2540] px-3 py-2 text-xs font-semibold text-white shadow-xl group-hover:block"
        x-show="collapsed" x-transition.opacity>
        {{ $slot }}
    </span>

</a>
