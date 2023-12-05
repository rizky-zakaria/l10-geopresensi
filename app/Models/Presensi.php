<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['keterangan', 'user_id', 'tanggal', 'periode'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apelPagi()
    {
        return $this->hasOne(ApelPagi::class);
    }

    public function apelSore()
    {
        return $this->hasOne(ApelSore::class);
    }

    public function sakit()
    {
        return $this->hasOne(Sakit::class);
    }

    public function setelahIshoma()
    {
        return $this->hasOne(SetelahIshoma::class);
    }

    public function dalamRuangan()
    {
        return $this->hasOne(DalamRuangan::class);
    }
}
