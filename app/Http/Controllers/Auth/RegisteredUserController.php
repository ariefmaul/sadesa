<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// Desa no longer loaded here; regions loaded dynamically
use App\Models\User;
use App\Notifications\MasyarakatBaruNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $provinsis = \App\Models\Provinsi::orderBy('nama')->get();

        return view('auth.register', compact('provinsis'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nik' => ['required', 'string', 'digits:16', 'unique:users,nik'],
            'name' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'desa_id' => ['required', 'exists:desas,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'desa_id' => $request->desa_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat',
            'status_verifikasi' => 'menunggu',
        ]);

        // Notify admin desa about new verification request (database notification)
        $adminDesa = User::query()
            ->where('role', 'admin_desa')
            ->where('desa_id', $request->desa_id)
            ->get();

        foreach ($adminDesa as $admin) {
            $admin->notify(new MasyarakatBaruNotification($user));
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
