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
        'tgl_penimbangan',
        'berat_badan',
        'tinggi_badan'
    ];
    protected $dates = [
        'tgl_penimbangan'
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}
