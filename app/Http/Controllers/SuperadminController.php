<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperadminController extends Controller
{
    // ================================================================================================================
    public function index()
    {
        $countSatker = DB::table('satkers')->count();
        $countAnggota = DB::table('anggotas')->count();
        $countUser = DB::table('users')->count();
        $users = DB::table('users')->join('satkers', 'satkers.satker_id', 'users.satker_id')->get();
        $satkers = DB::table('satkers')->get();
        $anggotas = DB::table('anggotas')->join('satkers','satkers.satker_id','anggotas.satker_id')->get();

        return view('superadmin.index', compact('countSatker', 'countAnggota', 'countUser', 'users', 'satkers','anggotas'));
    }

    // ================================================================================================================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'satker_id' => 'required',
            'user_name' => 'required',
            'user_password' => 'required',
            'user_role' => 'required'
        ]);

        try {
            DB::table('users')->insert($validatedData);
            return redirect()->back()->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan user: ' . $e->getMessage());
        }
    }


    // ================================================================================================================
    public function update(Request $request)
    {
        DB::table('users')->where('user_id', $request->user_id)->update(['user_password' => $request->user_password]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    // ================================================================================================================
    public function satker()
    {

        $satkers = DB::table('satkers')->get();

        return view('superadmin.satker', compact('satkers'));
    }
    // ================================================================================================================
    public function anggota()
    {
        $anggotas = DB::table('anggotas')->join('satkers', 'satkers.satker_id', 'anggotas.satker_id')->get();

        return view('superadmin.anggota', compact('anggotas'));
    }
}
