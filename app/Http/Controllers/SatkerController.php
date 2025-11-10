<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SatkerController extends Controller
{
    // ================================================================================================================
    public function index()
    {
        $nama_satker = DB::table('satkers')->where('satker_id', auth()->user()->satker_id)->value('satker_name');
        $total_anggota = DB::table('anggotas')->where('satker_id', auth()->user()->satker_id)->count();
        $anggotas = DB::table('anggotas')
            ->where('satker_id', auth()->user()->satker_id)
            ->limit(10)
            ->get();
        $absensis = DB::table('absensis')
            ->where('satker_id', auth()->user()->satker_id)
            ->whereDate('absensi_date', '>=', \Carbon\Carbon::now()->subWeek())
            ->get();

        return view('satker.index', compact('nama_satker', 'total_anggota', 'anggotas', 'absensis'));
    }

    // ================================================================================================================
    public function anggota()
    {
        $nama_satker = DB::table('satkers')->where('satker_id', auth()->user()->satker_id)->value('satker_name');
        $anggotas = DB::table('anggotas')
            ->where('satker_id', auth()->user()->satker_id)
            ->get();

        $satkers = DB::table('satkers')->get();

        return view('satker.anggota', compact('nama_satker', 'anggotas', 'satkers'));
    }

    // ================================================================================================================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'satker_id' => 'required',
            'anggota_name' => 'required',
            'anggota_pangkat' => 'required',
            'anggota_nrp' => 'required',
            'anggota_bidang' => 'required',
            'anggota_contact' => 'required',
            'anggota_address' => 'required',
            'anggota_jenis_kelamin' => 'required',
        ]);

        try {
            DB::table('anggotas')->insert($validatedData);
            return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan anggota: ' . $e->getMessage());
        }
    }

    // ================================================================================================================
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'anggota_id' => 'required',
            'anggota_name' => 'required',
            'anggota_pangkat' => 'required',
            'anggota_nrp' => 'required',
            'anggota_bidang' => 'required',
            'anggota_contact' => 'required',
            'anggota_address' => 'required',
            'anggota_jenis_kelamin' => 'required',
        ]);

        try {
            DB::table('anggotas')
                ->where('anggota_id', $validatedData['anggota_id'])
                ->update($validatedData);

            return redirect()->back()->with('success', 'Anggota berhasil di perbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat perbarui anggota: ' . $e->getMessage());
        }
    }

    // ================================================================================================================
    public function pindah(Request $request)
    {
        $validatedData = $request->validate([
            'anggota_id' => 'required|array',
            'anggota_id.*' => 'exists:anggotas,anggota_id',
            'satker_id' => 'required',
        ]);

        try {
            DB::table('anggotas')
                ->whereIn('anggota_id', $validatedData['anggota_id'])
                ->update(['satker_id' => $validatedData['satker_id']]);

            return redirect()->back()->with('success', 'Anggota berhasil dipindahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memindahkan anggota: ' . $e->getMessage());
        }
    }

    // ================================================================================================================
    public function riwayat(Request $request)
    {
        $nama_satker = DB::table('satkers')->where('satker_id', auth()->user()->satker_id)->value('satker_name');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {

            $absensi = DB::table('absensis')
                ->where('satker_id', auth()->user()->satker_id)
                ->get();

            return view('satker.riwayat', [
                'riwayat' => [],
                'absensi' => $absensi,
                'startDate' => null,
                'endDate' => null,
                'nama_satker' => $nama_satker,
            ]);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();

        $endDate = Carbon::parse($endDate)->endOfDay();

        $absensi = DB::table('absensis')
            ->where('satker_id', auth()->user()->satker_id)
            ->whereBetween('absensi_date', [$startDate, $endDate])
            ->get();

        return view('satker.riwayat', [
            'absensi' => $absensi,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'nama_satker' => $nama_satker,
        ]);
    }

    // ================================================================================================================
    public function riwayat_detail(Request $request)
    {
        $absensiId = $request->input('absensi_id');

        $riwayat = DB::table('absen_details')
            ->join('anggotas', 'anggotas.anggota_id', '=', 'absen_details.anggota_id')
            ->where('absensi_id', $absensiId)
            ->get();

        return response()->json([
            'riwayat' => $riwayat,
        ]);
    }


}
