<?php

namespace Database\Seeders;

use App\Models\Koordinat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoordinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koordinat::create([
            'latitude' => '0',
            'longitude' => '0'
        ]);
    }
}
