<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Giriş Sayfasını Göster
    public function showLogin() {
        return view('login');
    }

    // Giriş Yapma İşlemi
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Tekrar hoş geldin, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'E-posta veya şifre hatalı.'])->withInput();
    }

    // Kayıt Sayfasını Göster
    public function showRegister() {
        return view('register');
    }

    // Kayıt Olma İşlemi
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Kayıt olunca otomatik giriş yapsın

        return redirect('/')->with('success', 'Aramıza hoş geldin! Hesabın başarıyla oluşturuldu.');
    }

    // Çıkış Yapma İşlemi
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Başarıyla çıkış yapıldı.');
    }
}