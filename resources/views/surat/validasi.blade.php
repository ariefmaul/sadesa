<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Validasi Surat - SADESA</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100">

        <div class="flex items-center justify-center min-h-screen px-4">

            <div class="w-full max-w-lg p-8 bg-white shadow-sm rounded-xl">

                <div class="text-center">

                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
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

                        <span
                            class="inline-flex px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                            Dokumen Terverifikasi
                        </span>
                    </div>

                </div>

                <div class="mt-8 text-xs text-center text-gray-400">
                    SADESA — Sistem Administrasi Desa
                </div>

            </div>

        </div>

    </body>

</html>
