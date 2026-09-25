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
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <form class="p-6 space-y-4 bg-white rounded shadow-sm" method="POST"
                action="{{ route('admin.provinsi.store') }}">
                @csrf
                @include('admin.provinsi.form')

                <div class="flex justify-end">
                    <a class="px-4 py-2 border rounded-md" href="{{ route('admin.provinsi.index') }}">Batal</a>
                    <button class="px-4 py-2 ml-2 text-white bg-indigo-600 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>
