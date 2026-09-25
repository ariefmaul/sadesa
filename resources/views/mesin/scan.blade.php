<x-app-layout>

    <div class="py-10">
        <div class="max-w-2xl px-4 mx-auto sm:px-6">

            <div class="p-6 bg-white shadow-sm rounded-2xl">

                <div class="px-4 py-3 mt-6 text-sm text-center text-yellow-700 border border-yellow-200 rounded-lg bg-yellow-50"
                    id="status">
                    ⏳ Menyiapkan kamera...
                </div>

                <div class="mt-6">

                    <div class="w-full overflow-hidden bg-gray-100 border rounded-xl" id="reader">
                    </div>

                </div>

                <div class="hidden" id="result"></div>

            </div>

        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        let scanner = null;

        let scanning = false;

        let isProcessing = false;


        let lastScanTime = 0;


        const SCAN_COOLDOWN = 3000;




        const reader = document.getElementById('reader');

        const status = document.getElementById('status');




        function setStatus(message, type = 'info') {
            status.innerHTML = message;

            status.className =
                'mt-6 rounded-lg px-4 py-3 text-sm text-center';


            if (type === 'success') {

                status.classList.add(
                    'bg-green-50',
                    'border',
                    'border-green-200',
                    'text-green-700'
                );

            } else if (type === 'error') {

                status.classList.add(
                    'bg-red-50',
                    'border',
                    'border-red-200',
                    'text-red-700'
                );

            } else {

                status.classList.add(
                    'bg-yellow-50',
                    'border',
                    'border-yellow-200',
                    'text-yellow-700'
                );
            }
        }




        function extractToken(decodedText) {
            let token = decodedText;

            try {

                const url = new URL(decodedText);

                const parts = url.pathname
                    .split('/')
                    .filter(Boolean);

                if (parts.length > 0) {

                    token = parts[parts.length - 1];

                }

            } catch (error) {


                token = decodedText;

            }

            return token.trim();
        }




        async function startCamera() {
            if (scanning) {
                return;
            }


            setStatus(
                '⏳ Memeriksa kamera...'
            );


            try {



                if (
                    !navigator.mediaDevices ||
                    !navigator.mediaDevices.getUserMedia
                ) {

                    throw new Error(
                        'Browser tidak mendukung akses kamera.'
                    );

                }




                let testStream = null;

                try {

                    testStream =
                        await navigator.mediaDevices.getUserMedia({
                            video: true
                        });

                } catch (error) {

                    console.error(
                        'Camera permission error:',
                        error
                    );

                    alert(
                        'Akses kamera ditolak atau kamera tidak dapat digunakan.\n\n' +
                        'Silakan izinkan akses kamera untuk situs SADESA.'
                    );

                    setStatus(
                        '🔴 Kamera tidak dapat digunakan.',
                        'error'
                    );

                    return;
                }




                testStream
                    .getTracks()
                    .forEach(track => track.stop());




                if (!scanner) {

                    scanner =
                        new Html5Qrcode('reader');

                }




                const cameras =
                    await Html5Qrcode.getCameras();


                if (
                    !cameras ||
                    cameras.length === 0
                ) {

                    throw new Error(
                        'Tidak ada kamera yang ditemukan.'
                    );

                }




                let cameraId =
                    cameras[0].id;




                const backCamera =
                    cameras.find(camera =>
                        /back|rear|environment/i.test(
                            camera.label
                        )
                    );


                if (backCamera) {

                    cameraId =
                        backCamera.id;

                }




                await scanner.start(

                    cameraId,

                    {
                        fps: 20,

                        qrbox: {
                            width: 250,
                            height: 250
                        },

                        aspectRatio: 1.0
                    },

                    onScanSuccess,

                    onScanFailure

                );




                const video =
                    document.querySelector(
                        '#reader video'
                    );


                if (video) {

                    video.style.transform =
                        'scaleX(-1)';

                }


                scanning = true;


                setStatus(
                    '🟢 Kamera aktif. Arahkan QR Code surat ke kamera.',
                    'success'
                );


                console.log(
                    'SADESA camera started.'
                );

            } catch (error) {

                console.error(
                    'Camera error:',
                    error
                );


                setStatus(
                    '🔴 Kamera tidak dapat diaktifkan.',
                    'error'
                );


                alert(
                    'Kamera tidak dapat diaktifkan.\n\n' +
                    (error.message || 'Terjadi kesalahan pada kamera.')
                );

            }
        }




        function onScanSuccess(
            decodedText,
            decodedResult
        ) {

            console.log(
                'QR berhasil dibaca:',
                decodedText
            );




            const now =
                Date.now();


            if (isProcessing) {

                console.log(
                    'Scan sedang diproses. Abaikan.'
                );

                return;

            }


            if (
                now - lastScanTime <
                SCAN_COOLDOWN
            ) {

                console.log(
                    'Masih dalam cooldown.'
                );

                return;

            }


            lastScanTime =
                now;


            isProcessing = true;




            const token =
                extractToken(decodedText);


            console.log(
                'QR token:',
                token
            );




            const printWindow =
                window.open(
                    '',
                    '_blank'
                );




            if (!printWindow) {

                alert(
                    'Jendela cetak diblokir oleh browser.\n\n' +
                    'Silakan izinkan pop-up untuk situs SADESA.'
                );


                isProcessing = false;


                setStatus(
                    '🟢 Kamera aktif. Silakan scan QR kembali.',
                    'success'
                );


                return;

            }




            printWindow.document.open();

            printWindow.document.write(`
                <!DOCTYPE html>

                <html>

                <head>

                    <meta charset="UTF-8">

                    <title>
                        SADESA - Mencetak Dokumen
                    </title>

                    <style>

                        html,
                        body {
                            margin: 0;
                            padding: 0;
                            width: 100%;
                            height: 100%;
                            overflow: hidden;
                            background: #ffffff;
                        }

                        #pdfFrame {
                            width: 100%;
                            height: 100%;
                            border: 0;
                            display: block;
                        }

                        #loading {
                            position: fixed;
                            inset: 0;

                            display: flex;
                            align-items: center;
                            justify-content: center;

                            background: white;

                            font-family:
                                Arial,
                                sans-serif;

                            font-size: 18px;

                            color: #333;

                            z-index: 10;
                        }

                    </style>

                </head>

                <body>

                    <div id="loading">
                        ⏳ Menyiapkan dokumen untuk dicetak...
                    </div>

                    <iframe
                        id="pdfFrame"
                        style="display:none;"
                    ></iframe>

                </body>

                </html>
            `);

            printWindow.document.close();




            verifyToken(
                token,
                printWindow
            );
        }




        function onScanFailure(error) {

        }




        async function verifyToken(
            token,
            printWindow
        ) {

            setStatus(
                '⏳ QR ditemukan. Memverifikasi...',
                'info'
            );


            try {

                const verifyUrl =
                    "{{ route('mesin.verify') }}";




                const csrfMeta =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    );


                if (!csrfMeta) {

                    throw new Error(
                        'CSRF token tidak ditemukan.'
                    );

                }


                const csrfToken =
                    csrfMeta.getAttribute(
                        'content'
                    );




                const response =
                    await fetch(
                        verifyUrl, {
                            method: 'POST',

                            headers: {

                                'Content-Type': 'application/json',

                                'Accept': 'application/json',

                                'X-CSRF-TOKEN': csrfToken,

                                'X-Requested-With': 'XMLHttpRequest'

                            },

                            body: JSON.stringify({
                                token: token
                            })
                        }
                    );




                const rawResponse =
                    await response.text();


                console.log(
                    'SADESA VERIFY RESPONSE:', {
                        status: response.status,

                        raw: rawResponse
                    }
                );




                let data = null;


                try {

                    data =
                        JSON.parse(
                            rawResponse
                        );

                } catch (error) {

                    console.error(
                        'Response bukan JSON:',
                        rawResponse
                    );


                    closePrintWindow(
                        printWindow
                    );


                    alert(
                        'Server tidak mengembalikan data yang benar saat memverifikasi QR Code.'
                    );


                    resetScannerState();

                    return;
                }




                if (!response.ok) {

                    console.error(
                        'HTTP verification error:',
                        data
                    );


                    closePrintWindow(
                        printWindow
                    );


                    alert(
                        data?.message ||
                        'Terjadi kesalahan saat memverifikasi QR Code.'
                    );


                    resetScannerState();

                    return;
                }


                if (data && data.already_printed === true) {
                    console.warn('Dokumen sudah dicetak:', data.message);
                    closePrintWindow(printWindow);
                    alert(data.message || 'Dokumen sudah pernah dicetak.');
                    resetScannerState();
                    return;
                }




                if (
                    !data ||
                    data.success !== true
                ) {

                    console.warn(
                        'QR tidak valid:',
                        data
                    );


                    closePrintWindow(
                        printWindow
                    );


                    alert(
                        data?.message ||
                        'QR Code tidak valid.'
                    );


                    resetScannerState();

                    return;
                }




                const payload =
                    data.dokumen ??
                    data.data ??
                    data;


                console.log(
                    'SADESA DOCUMENT:',
                    payload
                );






                const pdfUrl =
                    payload.file_url ||
                    payload.pdf_url ||
                    payload.pdfUrl ||
                    null;


                if (!pdfUrl) {

                    console.error(
                        'PDF URL tidak ditemukan:',
                        payload
                    );


                    closePrintWindow(
                        printWindow
                    );


                    alert(
                        'File PDF dokumen tidak ditemukan.'
                    );


                    resetScannerState();

                    return;
                }




                console.log(
                    'PDF URL:',
                    pdfUrl
                );


                setStatus(
                    '✅ QR valid. Membuka dokumen untuk dicetak...',
                    'success'
                );




                openPdfForPrint(
                    printWindow,
                    pdfUrl,
                    payload.id
                );


            } catch (error) {

                console.error(
                    'Verification error:',
                    error
                );


                closePrintWindow(
                    printWindow
                );


                alert(
                    error.message ||
                    'Terjadi kesalahan saat memverifikasi QR Code.'
                );


                resetScannerState();

            }

        }




        function openPdfForPrint(
            printWindow,
            pdfUrl,
            dokumenId
        ) {

            try {

                if (
                    !printWindow ||
                    printWindow.closed
                ) {

                    alert(
                        'Jendela cetak tidak dapat dibuka. Silakan izinkan pop-up.'
                    );


                    resetScannerState();

                    return;
                }


                const frame =
                    printWindow.document.getElementById(
                        'pdfFrame'
                    );


                const loading =
                    printWindow.document.getElementById(
                        'loading'
                    );


                if (!frame) {

                    throw new Error(
                        'Frame PDF tidak ditemukan.'
                    );

                }




                frame.src =
                    pdfUrl;


                frame.style.display =
                    'block';




                let printStarted =
                    false;


                const startPrint =
                    function() {

                        if (printStarted) {
                            return;
                        }


                        printStarted =
                            true;


                        console.log(
                            'PDF selesai dimuat. Membuka print dialog.'
                        );


                        if (loading) {

                            loading.style.display =
                                'none';

                        }




                        setTimeout(
                            function() {

                                try {

                                    printWindow.focus();




                                    if (
                                        frame.contentWindow
                                    ) {

                                        frame.contentWindow.focus();

                                        frame.contentWindow.print();

                                    } else {

                                        printWindow.print();

                                    }

                                } catch (error) {

                                    console.warn(
                                        'Iframe print gagal, mencoba window.print():',
                                        error
                                    );


                                    try {

                                        printWindow.focus();

                                        printWindow.print();

                                    } catch (secondError) {

                                        console.error(
                                            'Window print gagal:',
                                            secondError
                                        );


                                        alert(
                                            'Dialog cetak tidak dapat dibuka otomatis. Silakan tekan Ctrl+P pada jendela dokumen.'
                                        );

                                    }

                                }




                                notifyPrinted(
                                    dokumenId
                                );


                                try {
                                    resetScannerState();
                                } catch (e) {
                                    console.warn('Failed to reset scanner state after print start', e);
                                }


                            },
                            1000
                        );

                    };




                frame.addEventListener(
                    'load',
                    startPrint, {
                        once: true
                    }
                );




                setTimeout(
                    function() {

                        if (!printStarted) {

                            console.warn(
                                'PDF load timeout. Mencoba print fallback.'
                            );


                            startPrint();

                        }

                    },
                    5000
                );


            } catch (error) {

                console.error(
                    'Open PDF error:',
                    error
                );


                closePrintWindow(
                    printWindow
                );


                alert(
                    'Dokumen PDF tidak dapat dibuka untuk dicetak.'
                );


                resetScannerState();

            }

        }




        async function notifyPrinted(
            dokumenId
        ) {

            if (!dokumenId) {
                return;
            }


            try {

                const csrfMeta =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    );


                if (!csrfMeta) {
                    return;
                }


                const csrfToken =
                    csrfMeta.getAttribute(
                        'content'
                    );


                const notifyUrl =
                    "{{ url('mesin/printed') }}/" +
                    dokumenId;


                const response =
                    await fetch(
                        notifyUrl, {
                            method: 'POST',

                            headers: {

                                'Content-Type': 'application/json',

                                'Accept': 'application/json',

                                'X-CSRF-TOKEN': csrfToken,

                                'X-Requested-With': 'XMLHttpRequest'

                            },

                            body: JSON.stringify({
                                printed: true
                            })
                        }
                    );


                console.log(
                    'Print notification:',
                    response.status
                );


            } catch (error) {



                console.warn(
                    'Gagal mencatat waktu cetak:',
                    error
                );

            }

        }




        function closePrintWindow(
            printWindow
        ) {

            try {

                if (
                    printWindow &&
                    !printWindow.closed
                ) {

                    printWindow.close();

                }

            } catch (error) {

                console.warn(
                    'Gagal menutup print window:',
                    error
                );

            }

        }




        function resetScannerState() {

            isProcessing =
                false;


            lastScanTime =
                Date.now();


            setStatus(
                '🟢 Kamera aktif. Arahkan QR Code surat ke kamera.',
                'success'
            );

        }




        document.addEventListener(
            'DOMContentLoaded',
            function() {

                console.log(
                    'SADESA Mesin Cetak: starting camera...'
                );


                startCamera();

            }
        );
    </script>

</x-app-layout>
