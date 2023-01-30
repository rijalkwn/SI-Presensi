<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepegawaian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }

    public function presensis()
    {
        return $this->hasManyThrough(Presensi::class, Karyawan::class);
    }
}
