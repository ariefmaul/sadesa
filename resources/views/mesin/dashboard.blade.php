<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mesin Cetak SADESA
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Scan QR Code untuk mencetak surat
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-65px)] bg-gray-100 py-10">

        <div class="max-w-xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                
                <div class="p-6 text-center border-b border-gray-100">

                    <div
                        class="mx-auto w-14 h-14 rounded-full bg-indigo-50
                                flex items-center justify-center text-2xl">
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

                    <div id="reader" class="w-full overflow-hidden rounded-xl border border-gray-200">
                    </div>

                    
                    <div id="loading" class="hidden mt-5 text-center">

                        <div class="inline-flex items-center gap-2 text-sm text-gray-600">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
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

                    
                    <div id="result" class="hidden mt-6">
                    </div>

                </div>

            </div>

            
            <div class="mt-5 text-center text-xs text-gray-500">

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

                <div class="rounded-xl border border-green-200
                            bg-green-50 p-5">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-green-100
                                    flex items-center justify-center">

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
                            class="block w-full text-center
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   font-semibold
                                   rounded-lg
                                   px-5 py-3">

                            🖨️ Cetak Surat

                        </a>

                    </div>


                    <button
                        onclick="reloadScanner()"
                        class="mt-3 w-full border
                               border-gray-300
                               bg-white
                               hover:bg-gray-50
                               text-gray-700
                               font-semibold
                               rounded-lg
                               px-5 py-3">

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

                <div class="rounded-xl
                            border border-red-200
                            bg-red-50
                            p-5">

                    <div class="text-center">

                        <div class="text-3xl">
                            ❌
                        </div>

                        <p class="mt-3
                                  font-semibold
                                  text-red-800">

                            QR Code Tidak Valid

                        </p>

                        <p class="mt-1
                                  text-sm
                                  text-red-700">

                            ${message}

                        </p>

                    </div>


                    <button
                        onclick="reloadScanner()"
                        class="mt-5 w-full
                               bg-red-600
                               hover:bg-red-700
                               text-white
                               font-semibold
                               rounded-lg
                               px-5 py-3">

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
