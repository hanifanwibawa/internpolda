<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // ================================================================================================================
    public function home(Request $request)
    {
        if (Auth::user()) {
            // Check user role
            if (Auth::user()->user_role == 'ADMIN_SATKER') {
                return redirect('/satker')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'DANTON') {
                return redirect('/danton')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'PAMENWAS') {
                return redirect('/pamenwas')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'SUPER_ADMIN') {
                return redirect('/superadmin')->with('success', 'Berhasil Login.');;
            }
        } else {
            return view('auth.login');
        }
    }


    // ================================================================================================================
    public function index()
    {
        return view('auth.login');
    }

    // ================================================================================================================
    public function auth(Request $request)
    {
        $credentials = $request->only('user_name', 'user_password');
        $credentials['password'] = $credentials['user_password'];
        unset($credentials['user_password']);

        if (Auth::attempt($credentials)) {
            // Check user role
            if (Auth::user()->user_role == 'ADMIN_SATKER') {
                return redirect('/satker')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'DANTON') {
                return redirect('/danton')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'PAMENWAS') {
                return redirect('/pamenwas')->with('success', 'Berhasil Login.');;
            }
            if (Auth::user()->user_role == 'SUPER_ADMIN') {
                return redirect('/superadmin')->with('success', 'Berhasil Login.');;
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->with('error', 'User Role tidak di temukan.');
        }

        return back()->with('error', 'Gagal login, silahkan cek kembali username dan password.');
    }

    // ================================================================================================================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
