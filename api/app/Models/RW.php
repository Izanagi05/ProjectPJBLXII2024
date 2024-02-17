<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;
    protected $table = 'rw';
    protected $primaryKey = 'rw_id';
    protected $fillable = ['nama', 'no', 'tanggal', 'kota', 'alamat', 'ketua_rw', 'wakil_rw'];

}
