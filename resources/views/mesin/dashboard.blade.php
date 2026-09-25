<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Mesin Cetak SADESA
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Scan QR Code untuk mencetak surat
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-65px)] bg-gray-100 py-10">

        <div class="max-w-xl px-4 mx-auto">

            <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-2xl">

                <div class="p-6 text-center border-b border-gray-100">

                    <div class="flex items-center justify-center mx-auto text-2xl rounded-full h-14 w-14 bg-indigo-50">
                        📷
                    </div>

                    <h1 class="mt-4 text-2xl font-bold text-gray-900">
                        Scan QR Code
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Arahkan QR Code surat ke kamera mesin untuk melakukan verifikasi.
                    </p>

                </div>

                <div class="p-6">

                    <div class="w-full overflow-hidden border border-gray-200 rounded-xl" id="reader">
                    </div>

                    <div class="hidden mt-5 text-center" id="loading">

                        <div class="inline-flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">

                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>

                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>

                            </svg>

                            Memverifikasi QR Code...
                        </div>

                    </div>

                    <div class="hidden mt-6" id="result">
                    </div>

                </div>

            </div>

            <div class="mt-5 text-xs text-center text-gray-500">

                <p>
                    Pastikan surat telah disetujui oleh Admin Desa.
                </p>

            </div>

        </div>

    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        let scanner;

        function onScanSuccess(decodedText) {


            if (scanner) {
                scanner.clear();
            }

            document
                .getElementById('loading')
                .classList
                .remove('hidden');

            let token = decodedText;



            try {

                const url = new URL(decodedText);

                const parts =
                    url.pathname
                    .split('/')
                    .filter(Boolean);

                token =
                    parts[parts.length - 1];

            } catch (error) {



                token = decodedText;

            }

            verifyToken(token);
        }


        function verifyToken(token) {

            fetch("{{ route('mesin.verify') }}", {

                    method: "POST",

                    headers: {

                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')

                    },

                    body: JSON.stringify({

                        token: token

                    })

                })

                .then(response => {

                    return response.json();

                })

                .then(result => {

                    document
                        .getElementById('loading')
                        .classList
                        .add('hidden');

                    if (!result.success) {

                        showError(
                            result.message ||
                            'QR Code tidak valid.'
                        );

                        return;

                    }

                    showDocument(result.data);

                })

                .catch(error => {

                    console.error(error);

                    document
                        .getElementById('loading')
                        .classList
                        .add('hidden');

                    showError(
                        'Terjadi kesalahan saat menghubungi server.'
                    );

                });

        }


        function showDocument(data) {

            const result =
                document.getElementById('result');

            result.classList.remove('hidden');

            result.innerHTML = `

                <div class="p-5 border border-green-200 rounded-xl bg-green-50">

                    <div class="flex items-center gap-3">

                        <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">

                            ✓

                        </div>

                        <div>

                            <p class="font-semibold text-green-800">
                                QR Code Valid
                            </p>

                            <p class="text-sm text-green-700">
                                Surat telah disetujui dan siap dicetak.
                            </p>

                        </div>

                    </div>


                    <div class="mt-5 space-y-4">

                        <div>

                            <p class="text-xs text-gray-500">
                                Nomor Dokumen
                            </p>

                            <p class="font-semibold text-gray-900">
                                ${data.nomor_dokumen}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-gray-500">
                                Nama Pemohon
                            </p>

                            <p class="font-semibold text-gray-900">
                                ${data.nama}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-gray-500">
                                Jenis Surat
                            </p>

                            <p class="font-semibold text-gray-900">
                                ${data.jenis_surat}
                            </p>

                        </div>

                    </div>


                    <div class="mt-6">

                        <a
                            href="/mesin/print/${data.id}"
                            class="block w-full px-5 py-3 font-semibold text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">

                            🖨️ Cetak Surat

                        </a>

                    </div>


                    <button
                        onclick="reloadScanner()"
                        class="w-full px-5 py-3 mt-3 font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">

                        Scan Surat Lain

                    </button>

                </div>

            `;
        }


        function showError(message) {

            const result =
                document.getElementById('result');

            result.classList.remove('hidden');

            result.innerHTML = `

                <div class="p-5 border border-red-200 rounded-xl bg-red-50">

                    <div class="text-center">

                        <div class="text-3xl">
                            ❌
                        </div>

                        <p class="mt-3 font-semibold text-red-800">

                            QR Code Tidak Valid

                        </p>

                        <p class="mt-1 text-sm text-red-700">

                            ${message}

                        </p>

                    </div>


                    <button
                        onclick="reloadScanner()"
                        class="w-full px-5 py-3 mt-5 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">

                        Scan Kembali

                    </button>

                </div>

            `;
        }


        function reloadScanner() {

            document
                .getElementById('result')
                .classList
                .add('hidden');

            document
                .getElementById('reader')
                .innerHTML = '';

            startScanner();

        }


        function startScanner() {

            scanner =
                new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,

                        qrbox: {
                            width: 250,
                            height: 250
                        },

                        rememberLastUsedCamera: true
                    }
                );

            scanner.render(
                onScanSuccess
            );

        }



        startScanner();
    </script>

</x-app-layout>
