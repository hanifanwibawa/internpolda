<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DantonController extends Controller
{
    // ================================================================================================================
    public function index()
    {
        $nama_satker = DB::table('satkers')->where('satker_id', auth()->user()->satker_id)->value('satker_name');
        $anggotas = DB::table('anggotas')
            ->where('satker_id', auth()->user()->satker_id)
            ->get();

        return view('danton.index', compact('nama_satker', 'anggotas'));
    }

    // ================================================================================================================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'satker_id' => 'required',
            'absensi_date' => 'required',
            'absensi_total' => 'required',
            'absensi_leave' => 'required',
        ]);

        try {
            $absensi_id = DB::table('absensis')->insertGetId([
                'satker_id' => $validatedData['satker_id'],
                'absensi_date' => $validatedData['absensi_date'],
                'absensi_total' => $validatedData['absensi_total'],
                'absensi_leave' => $validatedData['absensi_leave'],
            ]);

            if ($request->anggota_id) {
                $validatedData2 = $request->validate([
                    'anggota_id' => 'required|array',
                    'absen_status' => 'required|array',
                    'absen_note' => 'array',
                ]);

                $data = [];
                foreach ($validatedData2['anggota_id'] as $key => $value) {
                    $data[] = [
                        'absensi_id' => $absensi_id,
                        'anggota_id' => $value,
                        'absen_status' => $validatedData2['absen_status'][$key],
                        'absen_note' =>  isset($validatedData2['absen_note'][$key]) ? $validatedData2['absen_note'][$key] : '',
                    ];
                }

                DB::table('absen_details')->insert($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        }

        return redirect('/danton/riwayat')->with('success', 'Data berhasil di kirim.');
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

            return view('danton.riwayat', [
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

        return view('danton.riwayat', [
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
