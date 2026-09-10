<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transparansi Anggaran</h2>
            <a href="{{ route('admin.transparansi.create') }}"
                class="inline-flex items-center px-4 py-2 bg-[#163A6B] text-white rounded-md">Tambah Dokumen</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="space-y-4">
                    @forelse ($transparansi as $item)
                        <div class="border rounded-lg p-4">
                            <div class="flex items-center justify-between gap-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $item->judul }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->periode ?? 'Periode tidak diatur' }}</p>
                                </div>
                                <div>
                                    @if ($item->status === 'published')
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Published</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs">Draft</span>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-3 text-gray-700">{{ Str::limit($item->deskripsi ?? '-', 180) }}</p>
                            <div class="mt-4 flex gap-2 flex-wrap">
                                <a href="{{ route('admin.transparansi.edit', $item) }}"
                                    class="px-3 py-2 bg-gray-100 rounded text-sm">Edit</a>
                                <a href="{{ route('admin.transparansi.download', $item) }}"
                                    class="px-3 py-2 bg-blue-600 text-white rounded text-sm">Download</a>
                                <form action="{{ route('admin.transparansi.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-2 bg-red-600 text-white rounded text-sm">Hapus</button>
                                </form>
                                @if ($item->status === 'published')
                                    <form action="{{ route('admin.transparansi.unpublish', $item) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-2 bg-yellow-500 text-white rounded text-sm">Unpublish</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.transparansi.publish', $item) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-2 bg-green-600 text-white rounded text-sm">Publish</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-500">Belum ada dokumen transparansi anggaran.</div>
                    @endforelse
                </div>
                <div class="mt-6">{{ $transparansi->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
