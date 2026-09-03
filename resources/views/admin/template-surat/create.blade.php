<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Template Surat</h2>
            <a href="{{ route('admin.template-surat.index') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800">Kembali ke daftar</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.template-surat.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="nama" value="Nama Surat" />
                        <x-text-input id="nama" name="nama" class="mt-1 block w-full"
                            value="{{ old('nama') }}" placeholder="Surat Keterangan Tidak Mampu" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="kode" value="Kode Surat" />
                        <x-text-input id="kode" name="kode" class="mt-1 block w-full"
                            value="{{ old('kode') }}" placeholder="SKTM" required />
                        <p class="text-xs text-gray-500 mt-1">Gunakan kode singkat, mis. SKTM. Kode harus unik.</p>
                        <x-input-error :messages="$errors->get('kode')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="template" value="Template DOCX" />
                        <input id="template" name="template" type="file" accept=".docx" required
                            class="mt-1 block w-full text-sm text-gray-700" />
                        <p class="text-xs text-gray-500 mt-1">Unggah file .docx yang berisi placeholder seperti ${nama},
                            ${nik}, dsb.</p>
                        <x-input-error :messages="$errors->get('template')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Upload Template</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
