<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Field Template Surat</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $templateSurat->nama }}</p>
            </div>
            <a href="{{ route('admin.template-surat.index') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Tambah Field</h3>
                    @if (!empty($placeholders))
                        <div class="mb-4">
                            <h4 class="font-semibold text-sm text-gray-700">Placeholder terdeteksi dari template</h4>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($placeholders as $ph)
                                    <button type="button" data-placeholder="{{ $ph }}"
                                        class="create-placeholder px-3 py-1 rounded bg-yellow-100 text-sm text-yellow-800 border">{{ '${' . $ph . '}' }}</button>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Klik placeholder untuk mengisinya otomatis pada form
                                di bawah.</p>
                            <div class="mt-3">
                                <form method="POST"
                                    action="{{ route('admin.template-surat.fields.bulk', $templateSurat) }}">
                                    @csrf
                                    @foreach ($placeholders as $ph)
                                        <input type="hidden" name="placeholders[]" value="{{ $ph }}">
                                    @endforeach
                                    <button type="submit"
                                        class="mt-2 px-3 py-2 rounded bg-green-600 text-white text-sm font-semibold">Buat
                                        Semua Field</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <form id="add-field-form" action="{{ route('admin.template-surat.fields.store', $templateSurat) }}"
                        method="POST" class="mt-5 space-y-4">
                        @csrf
                        @include('admin.template-surat.field-form', ['field' => null])
                        <x-primary-button>Tambah Field</x-primary-button>
                    </form>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead
                                class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-4 py-3">Urutan</th>
                                    <th class="px-4 py-3">Placeholder</th>
                                    <th class="px-4 py-3">Label</th>
                                    <th class="px-4 py-3">Sumber</th>
                                    <th class="px-4 py-3">Tipe</th>
                                    <th class="px-4 py-3">Wajib</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($templateSurat->fields as $field)
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">{{ $field->urutan }}</td>
                                        <td class="px-4 py-3 font-mono text-gray-900">
                                            {{ '{{' . $field->fieldName() . ' ?>' }}'
                                            }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $field->label }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700">{{ $field->sourceData() }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $field->inputType() }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $field->isRequired() ? 'Ya' : 'Tidak' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.template-surat.fields.edit', [$templateSurat, $field]) }}"
                                                    class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('admin.template-surat.fields.destroy', [$templateSurat, $field]) }}"
                                                    onsubmit="return confirm('Hapus field ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="rounded-md border border-red-300 px-3 py-1.5 text-red-700 hover:bg-red-50">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada field.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.create-placeholder').forEach(btn => {
            btn.addEventListener('click', function() {
                const ph = this.getAttribute('data-placeholder');
                // fill form fields
                const nameInput = document.getElementById('nama_field');
                const labelInput = document.getElementById('label');
                const sumber = document.getElementById('sumber_data');
                const tipe = document.getElementById('tipe');

                if (nameInput) nameInput.value = ph.replace(/\s+/g, '_');
                if (labelInput) labelInput.value = ph.replace(/_/g, ' ').replace(/\b\w/g, l => l
                    .toUpperCase());

                // guess source: common profile keys
                const profileKeys = ['nama', 'nik', 'alamat', 'tempat_lahir', 'tanggal_lahir',
                    'agama', 'status_perkawinan', 'pekerjaan', 'email', 'desa'
                ];
                if (profileKeys.includes(ph)) {
                    if (sumber) sumber.value = 'profil';
                } else {
                    if (sumber) sumber.value = 'pengajuan';
                }

                if (tipe) tipe.value = 'text';
                // scroll to form
                document.getElementById('add-field-form').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
