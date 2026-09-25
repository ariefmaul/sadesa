@php
    $classes =
        [
            'menunggu' => 'bg-yellow-100 text-yellow-800 ring-yellow-600/20',
            'diproses' => 'bg-blue-100 text-blue-800 ring-blue-600/20',
            'disetujui' => 'bg-green-100 text-green-800 ring-green-600/20',
            'ditolak' => 'bg-red-100 text-red-800 ring-red-600/20',
            'dicetak' => 'bg-gray-100 text-gray-800 ring-gray-600/20',
        ][$status] ?? 'bg-gray-100 text-gray-800 ring-gray-600/20';
@endphp

<span class="{{ $classes }} inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset">
    {{ ucfirst($status ?? '-') }}
</span>
