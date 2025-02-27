<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas; 

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // ✅ Pastikan menggunakan guard yang benar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas', // ✅ Perbaiki validasi
            'password' => 'required|min:6',
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
