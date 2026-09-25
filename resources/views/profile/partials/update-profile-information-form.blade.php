<section>

    <header>

        <div class="flex items-start gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B3D91]/10 text-[#0B3D91]">

                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0Z" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0115 0" />

                </svg>

            </div>

            <div>

                <h2 class="text-lg font-bold tracking-tight text-[#0A2540] sm:text-xl">
                    {{ __('Profile Information') }}
                </h2>

                <p class="max-w-2xl mt-1 text-sm leading-6 text-slate-500">
                    {{ __("Update your account's profile information and email address.") }}
                </p>

            </div>

        </div>

    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">

        @csrf

    </form>

    <form class="mt-8 space-y-7" method="post" action="{{ route('profile.update') }}">

        @csrf
        @method('patch')

        <div>

            <x-input-label class="font-semibold text-[#0A2540]" for="name" :value="__('Name')" />

            <div class="relative mt-2">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0Z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0115 0" />

                    </svg>

                </div>

                <x-text-input
                    class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:bg-white focus:ring-[#2563EB]"
                    id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus
                    autocomplete="name" />

            </div>

            <x-input-error class="mt-2" :messages="$errors->get('name')" />

        </div>

        <div>

            <x-input-label class="font-semibold text-[#0A2540]" for="email" :value="__('Email')" />

            <div class="relative mt-2">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75Z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 7.5L12 13.125 19.5 7.5" />

                    </svg>

                </div>

                <x-text-input
                    class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:bg-white focus:ring-[#2563EB]"
                    id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />

            </div>

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())

                <div class="mt-4 overflow-hidden border rounded-2xl border-amber-200 bg-amber-50">

                    <div class="flex items-start gap-3 p-4">

                        <div
                            class="flex items-center justify-center rounded-lg h-9 w-9 shrink-0 bg-amber-100 text-amber-700">

                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m0 3h.008M10.5 3.75h3L21 18.75H3L10.5 3.75Z" />

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-semibold text-amber-900">
                                {{ __('Your email address is unverified.') }}
                            </p>

                            <p class="mt-1 text-xs leading-5 text-amber-800">
                                Verifikasi alamat email kamu untuk memastikan
                                akun tetap aman dan dapat digunakan dengan baik.
                            </p>

                            <button
                                class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-[#0B3D91] underline decoration-[#0B3D91]/30 underline-offset-4 transition hover:text-[#2563EB] hover:decoration-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                form="send-verification">

                                {{ __('Click here to re-send the verification email.') }}

                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 12h14m0 0l-5-5m5 5l-5 5" />

                                </svg>

                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <div
                                    class="mt-3 flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 px-3 py-2.5">

                                    <svg class="h-4 w-4 shrink-0 text-[#16A34A]" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

                                    </svg>

                                    <p class="text-xs font-medium text-green-700">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>

                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            @endif

        </div>

        <div class="flex flex-col gap-4 pt-6 border-t border-slate-100 sm:flex-row sm:items-center">

            <x-primary-button
                class="inline-flex justify-center rounded-xl bg-[#0B3D91] px-6 py-3 text-sm font-semibold shadow-sm transition duration-200 hover:bg-[#0A2540] focus:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4 4L19 7" />

                </svg>

                {{ __('Save Changes') }}

            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="inline-flex items-center gap-2 text-sm font-medium text-[#16A34A]" x-data="{ show: true }"
                    x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)">

                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-green-50">

                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4 4L19 7" />

                        </svg>

                    </span>

                    {{ __('Saved.') }}

                </p>
            @endif

        </div>

    </form>

</section>
