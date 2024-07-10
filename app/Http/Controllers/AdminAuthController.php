<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    function index(){
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        // dd($request->all());
        // Validasi data yang diterima dari form login
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd($data);

        // Coba melakukan proses login menggunakan Auth::attempt()
        if (Auth::attempt($data)) {
            // dd($request->all());
            // Jika berhasil, regenerasi session
            $request->session()->regenerate();
            
            // Dapatkan informasi pengguna yang masuk
            $user = User::where('username', $data['username'])->first();
            // $role = $user->role;
            // Tentukan rute yang akan diarahkan
            // dd($routeName);
            // Redirect ke rute yang sesuai dengan peran pengguna
            // dd($user);
            
            return redirect()->route('beranda');

        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->with('LoginError', 'Gagal Login, identitas atau password tidak ditemukan');
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

}
