<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link type="image/x-icon" href="{{ asset('images/logo.png') }}" rel="icon">

        <link href="https://fonts.bunny.net" rel="preconnect">

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-slate-100" x-data="{
            sidebarOpen: false
        }">

            @include('layouts.navigation')

            <div class="min-h-screen lg:pl-[260px]">

                <main
                    class="relative min-h-screen overflow-hidden bg-gradient-to-br from-[#0A2540] via-[#0B3D91] to-[#087F5B]">

                    <div class="absolute inset-0 overflow-hidden pointer-events-none">

                        <div
                            class="absolute -right-[240px] -top-[220px] h-[700px] w-[700px] rounded-full bg-[#16A34A]/30 blur-[90px]">
                        </div>

                        <div
                            class="absolute -right-[190px] -top-[170px] h-[580px] w-[580px] rounded-full bg-[#16A34A]/45 shadow-[0_0_100px_rgba(22,163,74,0.35)]">
                        </div>

                        <div
                            class="absolute -right-[110px] -top-[90px] h-[410px] w-[410px] rounded-full bg-[#16A34A]/30">
                        </div>

                        <div
                            class="absolute right-[30px] top-[70px] h-[210px] w-[210px] rounded-full bg-[#16A34A]/25 shadow-[0_0_80px_rgba(22,163,74,0.45)]">
                        </div>

                        <div
                            class="absolute -right-[150px] -top-[130px] h-[500px] w-[500px] rounded-full border-2 border-[#16A34A]/40">
                        </div>

                        <div
                            class="absolute -right-[70px] -top-[50px] h-[340px] w-[340px] rounded-full border border-white/15">
                        </div>

                        <div
                            class="bg-[#16A34A]/28 absolute -left-[280px] top-[32%] h-[620px] w-[620px] rounded-full blur-[70px]">
                        </div>

                        <div class="bg-[#16A34A]/38 absolute -left-[230px] top-[37%] h-[480px] w-[480px] rounded-full">
                        </div>

                        <div class="absolute -left-[120px] top-[44%] h-[280px] w-[280px] rounded-full bg-[#16A34A]/25">
                        </div>

                        <div
                            class="absolute -bottom-[300px] right-[10%] h-[650px] w-[650px] rounded-full bg-[#16A34A]/25 blur-[90px]">
                        </div>

                        <div
                            class="absolute -bottom-[250px] right-[15%] h-[450px] w-[450px] rounded-full bg-[#16A34A]/30">
                        </div>

                        <div class="absolute inset-0 opacity-[0.05]"
                            style="
            background-image:
                linear-gradient(rgba(255,255,255,0.8) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.8) 1px, transparent 1px);
            background-size: 45px 45px;
        ">
                        </div>

                        <div
                            class="absolute right-[120px] top-[190px] h-3 w-3 rounded-full bg-[#16A34A] shadow-[0_0_30px_rgba(22,163,74,0.9)]">
                        </div>

                        <div
                            class="absolute right-[190px] top-[250px] h-2 w-2 rounded-full bg-[#16A34A]/80 shadow-[0_0_20px_rgba(22,163,74,0.8)]">
                        </div>

                    </div>

                    <div class="relative z-10">

                        {{ $slot }}

                    </div>

                </main>

            </div>

        </div>

        @stack('scripts')
        <x-crud-loader />
    </body>

</html>
