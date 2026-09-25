<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Pengumuman Desa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <form class="space-y-5" method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="judul">Judul</label>
                        <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" id="judul"
                            name="judul" type="text" value="{{ old('judul', $pengumuman->judul) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="isi">Isi</label>
                        <textarea class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" id="isi" name="isi" rows="8"
                            required>{{ old('isi', $pengumuman->isi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="status">Status Publikasi</label>
                        <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" id="status"
                            name="status">
                            <option value="draft"
                                {{ old('status', $pengumuman->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published"
                                {{ old('status', $pengumuman->status) === 'published' ? 'selected' : '' }}>Published
                            </option>
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button class="rounded-md bg-[#163A6B] px-4 py-2 text-white" type="submit">Simpan
                            Perubahan</button>
                        <a class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md"
                            href="{{ route('admin.pengumuman.index') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
