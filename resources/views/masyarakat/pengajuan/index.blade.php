<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($surats as $surat)
                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $surat->nama }}</h3>
                                <p class="mt-2 text-sm text-gray-600">{{ $surat->deskripsi ?? 'Template surat tersedia untuk diajukan.' }}</p>
                            </div>
                            <span class="rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700">{{ $surat->fields->count() }} field</span>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('masyarakat.pengajuan.create', $surat) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Ajukan Surat</a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 text-center text-gray-500 shadow-sm sm:rounded-lg md:col-span-2 lg:col-span-3">
                        Belum ada surat yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
