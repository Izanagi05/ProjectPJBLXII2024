<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $primaryKey='pengeluaran_id';
    protected $fillable = [
        'nama_pengeluaran',
        'deskripsi',
        'tanggal_pengeluaran',
        'jumlah',
        'rt_id'
    ];
}
