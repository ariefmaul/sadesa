<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Transparansi Anggaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-500">{{ $transparansi->periode ?? 'Periode tidak diatur' }}</p>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">{{ $transparansi->judul }}</h3>
                </div>
                <p class="text-gray-700 whitespace-pre-line">{{ $transparansi->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('masyarakat.transparansi.download', $transparansi) }}"
                        class="inline-flex items-center px-4 py-2 bg-[#163A6B] text-white rounded-md">Download PDF</a>
                    <a href="{{ route('masyarakat.transparansi.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
