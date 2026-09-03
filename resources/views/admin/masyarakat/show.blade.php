<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Masyarakat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid gap-5 sm:grid-cols-2">
                        <div><dt class="text-sm text-gray-500">Nama</dt><dd class="mt-1 font-medium text-gray-900">{{ $masyarakat->name }}</dd></div>
                        <div><dt class="text-sm text-gray-500">NIK</dt><dd class="mt-1 font-medium text-gray-900">{{ $masyarakat->nik }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Jenis Kelamin</dt><dd class="mt-1 font-medium text-gray-900">{{ $masyarakat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Email</dt><dd class="mt-1 font-medium text-gray-900">{{ $masyarakat->email }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Status</dt><dd class="mt-1">@include('admin.partials.status-badge', ['status' => $masyarakat->status_verifikasi])</dd></div>
                        <div><dt class="text-sm text-gray-500">Tanggal Daftar</dt><dd class="mt-1 font-medium text-gray-900">{{ $masyarakat->created_at->format('d M Y H:i') }}</dd></div>
                    </dl>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('admin.masyarakat.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-center text-sm text-gray-700 hover:bg-gray-50">Kembali</a>
                        <form method="POST" action="{{ route('admin.masyarakat.reject', $masyarakat) }}" onsubmit="return confirm('Tolak akun masyarakat ini?')">
                            @csrf
                            @method('PATCH')
                            <button class="w-full rounded-md border border-red-300 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-50 sm:w-auto">Tolak</button>
                        </form>
                        <form method="POST" action="{{ route('admin.masyarakat.approve', $masyarakat) }}" onsubmit="return confirm('Setujui akun masyarakat ini?')">
                            @csrf
                            @method('PATCH')
                            <button class="w-full rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 sm:w-auto">Setujui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
