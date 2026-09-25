@if (session('success'))
    <div class="px-4 py-3 mb-6 text-sm text-green-700 border border-green-200 rounded-md bg-green-50">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="px-4 py-3 mb-6 text-sm text-red-700 border border-red-200 rounded-md bg-red-50">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="px-4 py-3 mb-6 text-sm text-red-700 border border-red-200 rounded-md bg-red-50">
        {{ $errors->first() }}
    </div>
@endif
