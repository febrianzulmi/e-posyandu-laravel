<?php

namespace App\Models;

use App\Models\User;
use App\Models\PerkembanganAnak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';
    protected $fillable = [
        'user_id',
        'nama',
        'jk',
        'tgl_lahir',
        'usia',
        'satuan_usia',
        'nama_orang_tua',
        'alamat'
    ];
    protected $dates = [
        'tgl_lahir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perkembanganAnak()
    {
        return $this->hasMany(PerkembanganAnak::class);
    }

    public function getJkAttribute($val)
    {
        if($val == 'l') {
            return 'Laki-laki';
        }

        return 'Perempuan';
    }

    public function getSatuanUsiaAttribute($val)
    {
        return ucfirst($val);
    }
}
