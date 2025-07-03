<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function form()
    {
        return view('auth.login');
    }

    public function formRegister()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            $user = Auth::user();
            if ($user->role === 'dokter') {
                return redirect()->intended('/dokter');
            } elseif ($user->role === 'pasien') {
                return redirect()->intended('/pasien');
            } elseif ($user->role === 'pasien') {
                return redirect()->intended('/pasien');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/admin');
            }

            // Default fallback
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'no_hp' => 'required|string|max:20',
            'no_ktp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'pasien', // default role
            'alamat' => $request->alamat,
        ]);

         // generate no_rm
         $no_rm = now()->format('Ym') . '-' . $user->id;

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'id_user' => $user->id,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm
        ]);


        return redirect()->route('login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
