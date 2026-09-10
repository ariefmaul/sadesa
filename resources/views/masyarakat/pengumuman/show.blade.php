<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengumuman</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-500">{{ $pengumuman->published_at?->translatedFormat('d F Y') }}</p>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">{{ $pengumuman->judul }}</h3>
                </div>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $pengumuman->isi }}
                </div>
                <div class="mt-6">
                    <a href="{{ route('masyarakat.pengumuman.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
