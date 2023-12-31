<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sakit extends Model
{
    use HasFactory;

    protected $fillable = ['keterangan', 'file', 'tanggal', 'presensi_id'];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }
}
