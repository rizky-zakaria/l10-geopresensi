<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\ApelPagi;
use App\Models\ApelSore;
use App\Models\Presensi;
use App\Models\Sakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SakitController extends Controller
{
    public function index()
    {
        $data = Sakit::orderBy('tanggal', 'desc')->get();
        return view('pegawai.sakit.index', compact('data'));
    }

    public function store(Request $request)
    {

        $uploadPath = public_path('uploads');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        $rename = '';

        if ($request->has('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $rename = 'file' . date('YmdHis') . '.' . $extension;
            $file->move($uploadPath, $rename);
        }

        if ($request->keterangan == 'sakit') {
            $presensi = Presensi::create([
                'keterangan' => 'Sakit',
                'tanggal' => date('Y-m-d'),
                'user_id' => Auth::user()->id,
                'periode' => date('Y-m')
            ]);

            Sakit::create([
                'keterangan' => 'sakit',
                'tanggal' => date('Y-m-d'),
                'file' => $rename,
                'presensi_id' => $presensi->id,
            ]);


            ApelPagi::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'sakit',
                'path' => 'uploads/' . $rename
            ]);

            ApelSore::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'sakit',
                'path' => 'uploads/' . $rename
            ]);
        } elseif ($request->keterangan == 'izin') {
            $presensi = Presensi::create([
                'keterangan' => 'Izin',
                'tanggal' => date('Y-m-d'),
                'user_id' => Auth::user()->id,
                'periode' => date('Y-m')
            ]);

            Sakit::create([
                'keterangan' => 'izin',
                'tanggal' => date('Y-m-d'),
                'file' => $rename,
                'presensi_id' => $presensi->id,
            ]);


            ApelPagi::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'izin',
                'path' => 'uploads/' . $rename
            ]);

            ApelSore::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'izin',
                'path' => 'uploads/' . $rename
            ]);
        } else {
            $presensi = Presensi::create([
                'keterangan' => 'Tugas Luar',
                'tanggal' => date('Y-m-d'),
                'user_id' => Auth::user()->id,
                'periode' => date('Y-m')
            ]);

            Sakit::create([
                'keterangan' => 'tl',
                'tanggal' => date('Y-m-d'),
                'file' => $rename,
                'presensi_id' => $presensi->id,
            ]);


            ApelPagi::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'tl',
                'path' => 'uploads/' . $rename
            ]);

            ApelSore::create([
                'presensi_id' => $presensi->id,
                'waktu' => 'tl',
                'path' => 'uploads/' . $rename
            ]);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $del = Sakit::find($id);
        $del->delete();

        return redirect()->back();
    }
}
