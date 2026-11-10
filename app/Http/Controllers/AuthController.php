<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $dashboardRoute = match (Auth::user()->role) {
            'admin' => 'admin.dashboard',
            'dokter' => 'dokter.dashboard',
            default => 'pasien.dashboard',
        };

        return Route::has($dashboardRoute)
            ? redirect()->intended(route($dashboardRoute))
            : redirect('/');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'string', 'max:32', 'unique:pasien,nik'],
            'no_hp' => ['required', 'string', 'max:32'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'pasien',
            ]);

            $pasien = $user->pasien()->create([
                'no_rm' => 'pending-'.Str::uuid(),
                'nik' => $data['no_ktp'],
                'nama_pasien' => $data['nama'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
            ]);

            $pasien->update([
                'no_rm' => now()->format('Ym').'-'.str_pad((string) $pasien->id, 3, '0', STR_PAD_LEFT),
            ]);
        });

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}