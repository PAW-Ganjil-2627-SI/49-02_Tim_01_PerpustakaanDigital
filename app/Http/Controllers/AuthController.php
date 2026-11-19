<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => 'Format email tidak valid.',
        ], [
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('penerbit.index'))
                ->with('success', 'Berhasil login sebagai '.Auth::user()->name.' ('.strtoupper(Auth::user()->role).').');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => 'Format email tidak valid.',
            'unique' => 'Email sudah terdaftar.',
            'min' => ':attribute minimal :min karakter.',
            'confirmed' => 'Konfirmasi password tidak cocok.',
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('penerbit.index')
            ->with('success', 'Registrasi berhasil! Anda login sebagai User.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah logout.');
    }
}
