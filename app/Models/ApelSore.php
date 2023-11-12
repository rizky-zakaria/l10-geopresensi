<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApelSore extends Model
{
    use HasFactory;


    protected $fillable = ['path', 'waktu', 'presensi_id'];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }
}
