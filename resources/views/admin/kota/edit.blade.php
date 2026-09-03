<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kota/Kabupaten</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.kota.update', $kota) }}"
                class="space-y-4 bg-white p-6 rounded shadow-sm">
                @csrf
                @method('PUT')
                @include('admin.kota.form')

                <div class="flex justify-end">
                    <a href="{{ route('admin.kota.index') }}" class="rounded-md border px-4 py-2">Batal</a>
                    <button class="ml-2 rounded-md bg-indigo-600 text-white px-4 py-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
