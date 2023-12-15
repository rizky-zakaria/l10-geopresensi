<?php

namespace Database\Seeders;

use App\Models\ApelPagi;
use App\Models\ApelSore;
use App\Models\Bidang;
use App\Models\DalamRuangan;
use App\Models\Presensi;
use App\Models\SetelahIshoma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            $id = Presensi::create([
                'tanggal' => date('Y-m-' . $i + 1),
                'keterangan' => '-',
                'user_id' => 2,
                'periode' => date('Y-m')
            ]);
            ApelPagi::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            DalamRuangan::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            SetelahIshoma::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            ApelSore::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
        }

        for ($i = 0; $i < 30; $i++) {
            $id = Presensi::create([
                'tanggal' => date('Y-' . 10 . '-' . $i + 1),
                'keterangan' => '-',
                'user_id' => 2,
                'periode' => date('Y-' . 10)
            ]);
            ApelPagi::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            DalamRuangan::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            SetelahIshoma::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);
            ApelSore::create([
                'presensi_id' => $id->id,
                'waktu' => date('H:i'),
                'path' => 'uploads/camera_capture_1699726418.png'
            ]);

            Bidang::create([
                'bidang' => 'Sarpras'
            ]);
        }
    }
}
