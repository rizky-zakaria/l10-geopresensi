<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'password' => Hash::make('123'),
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);

        Biodata::create([
            'name' => 'admin',
            'jk' => 'L',
            'jabatan' => 'Administrator',
            'user_id' => $admin->id
        ]);

        $pegawai = User::create([
            'password' => Hash::make('123'),
            'email' => 'pegawai@gmail.com',
            'role' => 'pegawai'
        ]);

        Biodata::create([
            'name' => 'Pegawai',
            'jk' => 'L',
            'jabatan' => 'Staff IT',
            'user_id' => $pegawai->id
        ]);
    }
}
