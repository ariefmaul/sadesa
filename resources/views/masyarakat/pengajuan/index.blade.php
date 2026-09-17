<x-app-layout>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                document.querySelectorAll('.btn-ajukan-langsung').forEach(function(button) {

                    button.addEventListener('click', function() {

                        const form = button.closest('.form-ajukan-langsung');

                        Swal.fire({
                            title: 'Ajukan surat?',
                            text: 'Tidak ada data tambahan yang perlu diisi. Surat akan langsung diajukan menggunakan data profil kamu.',
                            icon: 'question',

                            showCancelButton: true,

                            confirmButtonText: 'Ya, Ajukan',
                            cancelButtonText: 'Batal',

                            reverseButtons: true,
                            focusCancel: true,

                            buttonsStyling: false,

                            customClass: {
                                popup: 'rounded-2xl',
                                title: 'text-[#0A2540]',
                                htmlContainer: 'text-slate-500',

                                confirmButton: 'rounded-xl bg-[#0B3D91] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#0A2540]',

                                cancelButton: 'rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 mr-2'
                            }

                        }).then(function(result) {

                            if (result.isConfirmed) {

                                button.disabled = true;

                                button.querySelector('span').textContent = 'Mengajukan...';

                                form.submit();

                            }

                        });

                    });

                });

            });
        </script>
    @endpush

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Pelayanan Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Pengajuan Surat
            </h2>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F8FAFC] py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            
            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0B3D91] via-[#0B3D91] to-[#0A2540] p-6 shadow-xl sm:p-8">

                
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl">
                </div>

                <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-[#16A34A]/20 blur-3xl">
                </div>

                <div class="relative z-10 max-w-3xl">

                    <p class="text-sm font-medium text-blue-200">
                        Layanan Administrasi Desa
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Pengajuan Surat
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-blue-100 sm:text-base">
                        Pilih jenis surat yang ingin kamu ajukan. Proses pengajuan
                        dilakukan secara online dan dapat dipantau melalui sistem Sadesa.
                    </p>

                </div>
            </section>


            
            <section>

                
                <div class="mb-5">

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#2563EB]">
                        Layanan Tersedia
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-[#0A2540]">
                        Pilih Jenis Surat
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Pilih template surat sesuai dengan kebutuhan administrasi kamu.
                    </p>

                </div>


                
                <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">

                    @forelse($surats as $surat)
                        <div
                            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-[#2563EB]/30 hover:shadow-lg">

                            
                            <div
                                class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-blue-50 transition duration-300 group-hover:scale-125">
                            </div>
                            
                            <div class="relative flex items-start gap-4">

                                
                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl
               bg-[#0B3D91] text-white shadow-lg shadow-blue-900/20">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 3v5h5M9 13h6M9 17h4" />

                                    </svg>

                                </div>


                                
                                <div class="min-w-0 flex-1">

                                    <h3
                                        class="text-lg font-bold leading-6 text-[#0A2540]
                   transition group-hover:text-[#0B3D91]">

                                        {{ $surat->nama }}

                                    </h3>

                                    <p class="mt-1.5 text-sm leading-5 text-slate-500">

                                        {{ $surat->deskripsi ?? 'Template surat tersedia untuk diajukan.' }}

                                    </p>

                                </div>

                            </div>





                            
                            <div class="relative mt-5">

                                @if ($surat->fields->count() > 0)
                                    
                                    <div
                                        class="flex items-center gap-3 rounded-xl border border-blue-100 bg-blue-50/60 px-3 py-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-[#2563EB]">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6M9 16h4M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5" />

                                            </svg>

                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-xs font-semibold text-[#0A2540]">
                                                Formulir pengajuan
                                            </p>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                {{ $surat->fields->count() }} data perlu diisi
                                            </p>
                                        </div>

                                    </div>
                                @else
                                    
                                    <div
                                        class="flex items-center gap-3 rounded-xl border border-green-100 bg-green-50/70 px-3 py-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-100 text-[#16A34A]">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />

                                            </svg>

                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-xs font-semibold text-[#0A2540]">
                                                Tidak ada data yang perlu diisi
                                            </p>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                Surat dapat langsung diajukan
                                            </p>
                                        </div>

                                    </div>
                                @endif

                            </div>


                            
                            <div class="relative mt-6">

                                @if ($surat->fields->count() === 0)
                                    
                                    <form action="{{ route('masyarakat.pengajuan.store', $surat) }}" method="POST"
                                        class="form-ajukan-langsung">

                                        @csrf

                                        <button type="button"
                                            class="btn-ajukan-langsung group/button inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0B3D91] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                            <span>
                                                Ajukan Surat
                                            </span>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 transition-transform duration-200 group-hover/button:translate-x-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                                            </svg>

                                        </button>

                                    </form>
                                @else
                                    
                                    <a href="{{ route('masyarakat.pengajuan.create', $surat) }}"
                                        class="group/button inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0B3D91] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                        <span>
                                            Ajukan Surat
                                        </span>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform duration-200 group-hover/button:translate-x-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                                        </svg>

                                    </a>
                                @endif

                            </div>

                        </div>

                    @empty

                        
                        <div
                            class="rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center shadow-sm md:col-span-2 lg:col-span-3">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-[#0B3D91]">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5M9 13h6M9 17h4" />

                                </svg>

                            </div>


                            <h3 class="mt-4 text-lg font-bold text-[#0A2540]">
                                Belum Ada Surat
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                                Saat ini belum ada template surat yang tersedia
                                untuk diajukan.
                            </p>

                        </div>
                    @endforelse

                </div>

            </section>


            
            <div
                class="flex flex-col gap-2 border-t border-slate-200 pt-6 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">

                <p>
                    © {{ date('Y') }} Sistem Informasi Sadesa
                </p>

                <p>
                    <span class="font-semibold text-[#0B3D91]">
                        BIRU
                    </span>

                    ·

                    <span class="font-semibold text-[#16A34A]">
                        HIJAU
                    </span>

                    · Sistem Digital
                </p>

            </div>

        </div>

    </div>

</x-app-layout>
