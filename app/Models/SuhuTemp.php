<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuhuTemp extends Model
{
    protected $table = 'temp_suhu';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['suhu'];
}
