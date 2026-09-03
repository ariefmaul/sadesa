<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Admin Desa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.admin-desa.store') }}" class="space-y-5 p-6">
                    @csrf
                    @include('admin.admin-desa.form', ['isEdit' => false])
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.admin-desa.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
