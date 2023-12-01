<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BBTemp extends Model
{
    protected $table = 'temp_bb';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['bb'];
}
