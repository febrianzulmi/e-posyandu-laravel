<?php

namespace App\Models;

use App\Models\Anak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerkembanganAnak extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_anak';
    protected $fillable = [
        'anak_id',
        'uid',
        'tgl_pemeriksaan',
        'bb',
        'tb',
        'suhu'
    ];
    protected $dates = [
        'tgl_pemeriksaan',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}
