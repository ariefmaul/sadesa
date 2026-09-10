<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Transparansi Anggaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form method="POST" action="{{ route('admin.transparansi.store') }}" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input id="judul" name="judul" type="text" value="{{ old('judul') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div>
                        <label for="periode" class="block text-sm font-medium text-gray-700">Tahun/Periode</label>
                        <input id="periode" name="periode" type="text" value="{{ old('periode') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="pdf" class="block text-sm font-medium text-gray-700">File PDF</label>
                        <input id="pdf" name="pdf" type="file" accept="application/pdf"
                            class="mt-1 block w-full text-sm text-gray-700" required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="bg-[#163A6B] text-white px-4 py-2 rounded-md">Simpan</button>
                        <a href="{{ route('admin.transparansi.index') }}"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
