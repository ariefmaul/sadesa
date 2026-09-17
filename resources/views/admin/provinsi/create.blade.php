<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Data Wilayah
            </p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Tambah Provinsi
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan data provinsi baru ke dalam sistem.
            </p>
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.provinsi.store') }}"
                class="space-y-4 bg-white p-6 rounded shadow-sm">
                @csrf
                @include('admin.provinsi.form')

                <div class="flex justify-end">
                    <a href="{{ route('admin.provinsi.index') }}" class="rounded-md border px-4 py-2">Batal</a>
                    <button class="ml-2 rounded-md bg-indigo-600 text-white px-4 py-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
