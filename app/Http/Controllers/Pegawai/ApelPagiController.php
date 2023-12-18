<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\ApelPagi;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ApelPagiController extends Controller
{
    public function index()
    {
        $data = ApelPagi::with('presensi')
            ->orderBy('created_at', 'desc')->get();

        return view('pegawai.apel-pagi.index', compact('data'));
    }

    public function create()
    {
        $data = ApelPagi::join('presensis', 'presensis.id', '=', 'apel_pagis.presensi_id')
            ->where('presensis.user_id', Auth::user()->id)->where('presensis.tanggal', date('Y-m-d'))
            ->get();
        if (count($data) > 0) {
            Alert::error('Anda telah melakukan presensi');
            return redirect(url('pegawai/apel-pagi'));
        }
        return view('pegawai.apel-pagi.create');
    }

    public function postLokasi(Request $request)
    {
        // dishub kota = 0.5269178, 123.0562128
        // dishub prov 0.5999216, 123.0712941
        // kampus 4 0.5563289, 123.1317879
        //kost 0.5533161666666666, 123.145076
        $distance = getDistance(0.5999216, 123.0712941, $request->lat, $request->long);
        if ($distance >= 300) {
            Alert::warning('Anda terlalu jauh dari kantor!');
            return redirect()->back();
        }
        return view('pegawai.apel-pagi.camera');
    }

    public function postImage(Request $request)
    {
        $image = $request->get('image'); // Atau $request->image jika menggunakan FormData
        $fileName = 'camera_capture_' . time() . '.png';
        $path = 'uploads/' . $fileName;

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        file_put_contents($path, $image);
        $presensi = Presensi::create([
            'keterangan' => '-',
            'tanggal' => date('Y-m-d'),
            'user_id' => Auth::user()->id,
            'periode' => date('Y-m')
        ]);
        ApelPagi::create([
            'presensi_id' => $presensi->id,
            'waktu' => date('H:i'),
            'path' => $path
        ]);

        return response()->json(['success' => true, 'path' => $path]);
    }

    public function successPost()
    {
        Alert::success('Berhasil melakukan presensi');
        return redirect(url('pegawai/apel-pagi'));
    }
}
