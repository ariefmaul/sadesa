<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Validasi Surat - SADESA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-lg bg-white rounded-xl shadow-sm p-8">

            <div class="text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                    ✓
                </div>

                <h1 class="text-xl font-bold text-gray-900">
                    Surat Valid
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Dokumen ini diterbitkan melalui sistem SADESA.
                </p>

            </div>

            <div class="mt-8 space-y-4">

                <div>
                    <p class="text-sm text-gray-500">
                        Nomor Pengajuan
                    </p>

                    <p class="font-semibold">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Nama
                    </p>

                    <p class="font-semibold">
                        {{ $pengajuan->user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Jenis Surat
                    </p>

                    <p class="font-semibold">
                        {{ $pengajuan->jenisSurat->nama }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                        Dokumen Terverifikasi
                    </span>
                </div>

            </div>

            <div class="mt-8 text-center text-xs text-gray-400">
                SADESA — Sistem Administrasi Desa
            </div>

        </div>

    </div>

</body>

</html>
