<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Presensi::with('user')
            ->orderBy('tanggal', 'desc')->get();
        return view('admin.report.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetakLaporan(Request $request)
    {
        if ($request->jenis == 'bulanan') {

            $bulans = [
                'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
            ];
            // dd($bulan[$request->waktu]);
            $bul = $bulans[$request->waktu - 1];
            $data = User::where('users.role', '!=', 'admin')
                ->with('presensi', 'biodata')->get();


            if (count($data) < 1) {
                Alert::error('Data tidak ditemukan');
                return redirect()->back();
            }
            $days = count($data[0]->presensi);
            $bulan = date('Y-') . $request->waktu;

            $pdf = Pdf::loadview('admin.report.cetak-bulanan', [
                'data' => $data,
                'days' => $days,
                'bulan' => $bulan,
                'bul' => $bul
            ])->setPaper('A4', 'landscape');
            return $pdf->stream();
        } else {
            $data = Presensi::with('user')->where('tanggal', $request->waktu)->get();
            $pdf = Pdf::loadview('admin.report.cetak-harian', [
                'data' => $data,
                'waktu' => $request->waktu
            ])->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
    }
}
