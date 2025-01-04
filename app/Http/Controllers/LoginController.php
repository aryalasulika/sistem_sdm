<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if ($this->guard()->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali!');
        }

        return redirect()->route('login')
            ->withInput($request->only('email'))
            ->withErrors([
                'login_error' => 'Email atau password yang Anda masukkan salah.'
            ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda berhasil keluar dari sistem');
    }
}
