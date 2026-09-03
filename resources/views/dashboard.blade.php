<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success') || session('error'))
                <div class="mb-6 rounded-md border {{ session('error') ? 'border-red-200 bg-red-50 text-red-700' : 'border-green-200 bg-green-50 text-green-700' }} px-4 py-3 text-sm">
                    {{ session('success') ?? session('error') }}
                </div>
            @endif

            <div class="grid gap-6 md:grid-cols-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">Status Verifikasi</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ Auth::user()->status_verifikasi ?? '-' }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">Desa</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ Auth::user()->desa?->nama ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
