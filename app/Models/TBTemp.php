<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBTemp extends Model
{
    protected $table = 'temp_tb';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['tb'];
}
