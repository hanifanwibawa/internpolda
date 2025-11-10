<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PamenwasController extends Controller
{
    // ================================================================================================================
    public function index()
    {
        $satkers = DB::table('satkers')->get();
        $totalPersonil  = DB::table('anggotas')->count();
        $totalHadir = DB::table('absensis')
            ->where('absensi_date', Carbon::today())
            ->selectRaw('SUM(absensi_total - absensi_leave) AS total_hadir')
            ->value('total_hadir');
        $totalTidakHadir = DB::table('absensis')
            ->where('absensi_date', Carbon::today())
            ->selectRaw('SUM(absensi_leave) AS total_tidak_hadir')
            ->value('total_tidak_hadir');
        $absensi_leave = DB::table('absen_details')
            ->select('anggotas.anggota_name', 'satkers.satker_name', 'absensis.absensi_date', 'absen_details.absen_status', 'absen_details.absen_note')
            ->join('anggotas', 'absen_details.anggota_id', '=', 'anggotas.anggota_id')
            ->join('satkers', 'anggotas.satker_id', '=', 'satkers.satker_id')
            ->join('absensis', 'absen_details.absensi_id', '=', 'absensis.absensi_id')
            ->where('absensi_date', Carbon::today())
            ->paginate(10);

        return view('pamenwas.index', compact('satkers', 'totalPersonil', 'totalHadir', 'totalTidakHadir', 'absensi_leave'));
    }

    // ================================================================================================================
    public function riwayat(Request $request, $id = null)
    {
        $nama_satker = DB::table('satkers')->where('satker_id', $id)->value('satker_name');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if (!$startDate || !$endDate) {
            return view('pamenwas.riwayat', [
                'riwayat' => [],
                'absensi' => [],
                'startDate' => null,
                'endDate' => null,
                'nama_satker' => $nama_satker,
            ]);
        }
        $startDate = Carbon::parse($startDate)->startOfDay();

        $endDate = Carbon::parse($endDate)->endOfDay();

        if ($id == null) {
            $absensi = DB::table('absensis')->where('absensi_date', '>=', $startDate)
                ->where('absensi_date', '<=', $endDate)
                ->get();
        } else {
            $absensi = DB::table('absensis')->where('satker_id', $id)
                ->where('absensi_date', '>=', $startDate)
                ->where('absensi_date', '<=', $endDate)
                ->get();
        }

        return view('pamenwas.riwayat', [
            'absensi' => $absensi,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'nama_satker' => $nama_satker,
        ]);
    }

    // ================================================================================================================
    public function riwayat_semua(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startDate = Carbon::parse($startDate)->startOfDay();

        $endDate = Carbon::parse($endDate)->endOfDay();

        $absensi = DB::table('absensis')
            ->join('satkers', 'absensis.satker_id', '=', 'satkers.satker_id')
            ->where('absensi_date', '>=', $startDate)
            ->where('absensi_date', '<=', $endDate)
            ->get();

        return view('pamenwas.riwayat_semua', [
            'absensi' => $absensi,
            'startDate' => $startDate,
            'endDate' => $endDate,
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

    // ================================================================================================================
    public function riwayat_semua_detail(Request $request)
    {
        $absensiId = $request->input('absensi_id');

        $absensi_date = DB::table('absen_details')
            ->join('absensis', 'absensis.absensi_id', '=', 'absen_details.absensi_id')
            ->where('absensis.absensi_id', $absensiId)
            ->value('absensi_date');

        $riwayat = DB::table('absen_details')
            ->join('absensis', 'absensis.absensi_id', '=', 'absen_details.absensi_id')
            ->join('anggotas', 'anggotas.anggota_id', '=', 'absen_details.anggota_id')
            ->join('satkers', 'satkers.satker_id', '=', 'anggotas.satker_id')
            ->where('absensi_date', $absensi_date)
            ->get();

        return response()->json([
            'riwayat' => $riwayat,
        ]);
    }

    // ================================================================================================================
    public function riwayat_tidak_hadir(Request $request)
    {
        $absensiId = $request->input('absensi_id');

        $riwayat = DB::table('absen_details')
            ->select('anggotas.anggota_name', 'satkers.satker_name', 'absen_details.absen_status', 'absen_details.absen_note')
            ->join('anggotas', 'absen_details.anggota_id', '=', 'anggotas.anggota_id')
            ->join('satkers', 'anggotas.satker_id', '=', 'satkers.satker_id')
            ->where('absen_details.absensi_id', $absensiId)
            ->where('absen_status', 'TIDAK HADIR')
            ->get();

        return response()->json([
            'riwayat' => $riwayat,
        ]);
    }

    // ================================================================================================================
    public function rekap(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startDate = Carbon::parse($startDate)->startOfDay();

        $endDate = Carbon::parse($endDate)->endOfDay();

        $absensi = DB::table('absensis')
            ->join('satkers', 'absensis.satker_id', '=', 'satkers.satker_id')
            ->where('absensi_date', '>=', $startDate)
            ->where('absensi_date', '<=', $endDate)
            ->paginate(10);


        return view('pamenwas.rekap', [
            'absensi' => $absensi,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    // ================================================================================================================
    public function print(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if (!$startDate || !$endDate) {
            return redirect()->route('pamenwas.rekap');
        }
        $startDate = Carbon::parse($startDate)->startOfDay();

        $endDate = Carbon::parse($endDate)->endOfDay();

        $absensi = DB::table('absensis')
            ->join('satkers', 'absensis.satker_id', '=', 'satkers.satker_id')
            ->where('absensi_date', '>=', $startDate)
            ->where('absensi_date', '<=', $endDate)
            ->get();

        return view('pamenwas.print', [
            'absensi' => $absensi,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
