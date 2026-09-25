<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Desa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.desa.store') }}" class="p-6 space-y-5">
                    @csrf
                    @include('admin.desa.form')
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.desa.index') }}" class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
