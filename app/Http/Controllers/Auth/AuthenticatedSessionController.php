<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Prefer role-based landing pages. If you want to preserve a prior intended
        // URL (user tried to access a protected page), you can use intended()
        // here — but for mesin we force the scanner landing so the device
        // always opens the scanner after login.
        return match ($user->role) {
            'mesin', 'mesin_cetak' => redirect()->route('mesin.scan'),
            'masyarakat' => redirect()->route('masyarakat.pengajuan.index'),
            'admin_desa', 'super_admin' => redirect()->route('admin.template-surat.index'),
            default => redirect()->intended(route('dashboard', absolute: false)),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
