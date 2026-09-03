<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Template Surat</h2>
            <a href="{{ route('admin.template-surat.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-indigo-700">+
                Tambah Template</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($templates->isEmpty())
                    <div class="text-center py-10 text-gray-500">Belum ada template surat.</div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($templates as $template)
                            <div class="border rounded-lg p-4 bg-white">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $template->nama }}</h3>
                                        <div class="mt-1 text-sm text-gray-500">{{ $template->deskripsi }}</div>
                                    </div>
                                    <div class="text-right text-xs text-gray-500">
                                        <div class="font-mono">{{ $template->kode }}</div>
                                        <div class="mt-2">
                                            @if ($template->aktif)
                                                <span
                                                    class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded">Aktif</span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-0.5 bg-gray-100 text-gray-700 rounded">Tidak
                                                    Aktif</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="text-sm text-gray-700">
                                        @if ($template->template)
                                            <div>File: <span
                                                    class="font-mono">{{ basename($template->template) }}</span></div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.template-surat.fields', $template) }}"
                                            class="px-3 py-1 rounded bg-gray-100 text-sm text-gray-700">Kelola Field</a>

                                        <form action="{{ route('admin.template-surat.destroy', $template) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus template ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 rounded bg-red-600 text-white text-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mt-6">
                {{ $templates->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
