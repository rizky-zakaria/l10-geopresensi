<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function index()
    {
        $data = Presensi::with('user')
            ->where('user_id', Auth::user()->id)
            ->orderBy('tanggal', 'desc')->get();
        return view('pegawai.presensi.index', compact('data'));
    }

    public function create()
    {
        $data = Presensi::where('user_id', Auth::user()->id)->where('tanggal', date('Y-m-d'))->get();
        if (count($data) > 0) {
            Alert::error('Anda telah melakukan presensi');
            return redirect(url('pegawai/presensi'));
        }
        return view('pegawai.presensi.create');
    }

    public function postLokasi(Request $request)
    {
        // dishub kota = 0.5269178,123.0562128
        // dishub prov 0.5999216,123.0712941
        $distance = getDistance(0.5999216, 123.0712941, $request->lat, $request->long);
        if ($distance >= 300) {
            Alert::warning('Anda terlalu jauh dari kantor!');
            return redirect()->back();
        }
        return view('pegawai.presensi.camera');
    }

    public function postImage(Request $request)
    {
        $image = $request->get('image'); // Atau $request->image jika menggunakan FormData
        $fileName = 'camera_capture_' . time() . '.png';
        $path = 'public/uploads/' . $fileName;

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

        Storage::put($path, $image);
        Presensi::create([
            'presensi' => 'hadir',
            'keterangan' => '-',
            'tanggal' => date('Y-m-d'),
            'user_id' => Auth::user()->id,
            'path' => $path
        ]);

        return response()->json(['success' => true, 'path' => $path]);
    }

    public function successPost()
    {
        Alert::success('Berhasil melakukan presensi');
        return redirect(url('pegawai/presensi'));
    }
}
