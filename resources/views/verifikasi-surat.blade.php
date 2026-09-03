<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Surat - SADESA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-lg bg-white rounded-xl shadow-sm p-8">

            <div class="text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-gray-900">
                    Surat Terverifikasi
                </h1>

                <p class="mt-2 text-gray-500">
                    Dokumen ini merupakan surat resmi yang diterbitkan melalui SADESA.
                </p>

            </div>

            <div class="mt-8 space-y-4">

                <div>
                    <p class="text-sm text-gray-500">
                        Nomor Dokumen
                    </p>

                    <p class="font-semibold text-gray-900">
                        {{ $dokumen->nomor_dokumen }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Jenis Surat
                    </p>

                    <p class="font-semibold text-gray-900">
                        {{ $dokumen->pengajuanSurat->jenisSurat->nama }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Pemohon
                    </p>

                    <p class="font-semibold text-gray-900">
                        {{ $dokumen->pengajuanSurat->user->name }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</body>

</html>
