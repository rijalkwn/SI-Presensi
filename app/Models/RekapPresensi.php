<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPresensi extends Model
{
    use HasFactory;

    protected $table = 'rekap_presensis';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
