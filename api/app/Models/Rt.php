<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $primaryKey = 'rt_id';

    protected $fillable = [
        'rt',
        'ketua_rt',
        'wakil_ketua_rt',
    ];
}
