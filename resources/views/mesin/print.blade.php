<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cetak Surat - {{ $dokumen->nomor_dokumen }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: 
            font-family: Arial, sans-serif;
        }

        .print-container {
            width: 100%;
            min-height: 100vh;
        }

        .toolbar {
            padding: 15px;
            background: 
            border-bottom: 1px solid 
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-print {
            background: 
            color: white;
        }

        .btn-close {
            background: 
            color: white;
        }

        .document {
            padding: 30px;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 70px);
            border: none;
        }

        @media print {
            .toolbar {
                display: none;
            }

            iframe {
                height: 100vh;
            }
        }
    </style>
</head>

<body>

    <div class="print-container">

        <div class="toolbar">
            <button onclick="window.print()" class="btn btn-print">
                🖨 Cetak
            </button>

            <button onclick="window.close()" class="btn btn-close">
                Tutup
            </button>
        </div>

        @if (!empty($dokumen->dokumen_pdf))
            <iframe id="pdfFrame" src="{{ asset('storage/' . $dokumen->dokumen_pdf) }}">
            </iframe>

            <script>
                
                const iframe = document.getElementById('pdfFrame');
                iframe.addEventListener('load', function() {
                    try {
                        iframe.contentWindow.focus();
                        
                        setTimeout(async () => {
                            
                            try {
                                iframe.contentWindow.print();
                            } catch (err) {
                                window.print();
                            }

                            
                            try {
                                await fetch("{{ route('mesin.printed', $dokumen) }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        printed: true
                                    })
                                });
                            } catch (e) {
                                
                            }

                        }, 500);
                    } catch (e) {
                        
                        setTimeout(() => window.print(), 800);
                    }
                });
            </script>
        @else
            <div class="document">

                <h2>Dokumen Belum Memiliki PDF</h2>

                <p>
                    Nomor Dokumen:
                    <strong>{{ $dokumen->nomor_dokumen }}</strong>
                </p>

                <p>
                    File Word tersedia, tetapi belum dikonversi menjadi PDF.
                </p>

                <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank">
                    Buka Dokumen Word
                </a>

            </div>
        @endif

    </div>

</body>

</html>
