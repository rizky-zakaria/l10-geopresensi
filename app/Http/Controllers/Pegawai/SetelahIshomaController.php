<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\DalamRuangan;
use App\Models\Presensi;
use App\Models\SetelahIshoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SetelahIshomaController extends Controller
{
    public function index()
    {
        $data = SetelahIshoma::with('presensi')
            ->orderBy('created_at', 'desc')->get();
        return view('pegawai.setelah-ishoma.index', compact('data'));
    }

    public function create()
    {
        $cek = DalamRuangan::join('presensis', 'presensis.id', '=', 'dalam_ruangans.presensi_id')
            ->where('presensis.user_id', Auth::user()->id)
            ->where('presensis.tanggal', date('Y-m-d'))
            ->get();
        if (count($cek) < 1) {
            Alert::error('Anda belum melakukan presensi apel pagi');
            return redirect(url('pegawai/setelah-ishoma'));
        }
        $data = SetelahIshoma::join('presensis', 'presensis.id', '=', 'setelah_ishomas.presensi_id')
            ->where('presensis.user_id', Auth::user()->id)->where('presensis.tanggal', date('Y-m-d'))
            ->get();
        if (count($data) > 0) {
            Alert::error('Anda telah melakukan presensi');
            return redirect(url('pegawai/setelah-ishoma'));
        }
        return view('pegawai.setelah-ishoma.create');
    }

    public function postLokasi(Request $request)
    {
        // dishub kota = 0.5269178,123.0562128
        // dishub prov 0.5999216,123.0712941
        $distance = getDistance(0.5594692471015614, 123.05093640516309, $request->lat, $request->long);
        if ($distance >= 300) {
            Alert::warning('Anda terlalu jauh dari kantor!');
            return redirect()->back();
        }
        return view('pegawai.setelah-ishoma.camera');
    }

    public function postImage(Request $request)
    {
        $image = $request->get('image'); // Atau $request->image jika menggunakan FormData
        $fileName = 'camera_capture_' . time() . '.png';
        $path = 'uploads/' . $fileName;

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        file_put_contents($path, $image);

        $presensi = Presensi::where('user_id', Auth::user()->id)->where('tanggal', date('Y-m-d'))->first();
        SetelahIshoma::create([
            'presensi_id' => $presensi->id,
            'waktu' => date('H:i'),
            'path' => $path
        ]);

        return response()->json(['success' => true, 'path' => $path]);
    }

    public function successPost()
    {
        Alert::success('Berhasil melakukan presensi');
        return redirect(url('pegawai/setelah-ishoma'));
    }
}
