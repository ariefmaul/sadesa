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
     * Show the login view.
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
        $defaultTarget = route('dashboard', absolute: false);
        $roleTarget = match ($user->role) {
            'mesin', 'mesin_cetak' => route('mesin.scan', absolute: false),
            'masyarakat' => route('masyarakat.pengajuan.index', absolute: false),
            'admin_desa', 'super_admin' => route('admin.template-surat.index', absolute: false),
            default => $defaultTarget,
        };

        if ($request->has('redirect_to') || session()->has('url.intended')) {
            return redirect()->intended($roleTarget);
        }

        return redirect()->to($defaultTarget);
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
