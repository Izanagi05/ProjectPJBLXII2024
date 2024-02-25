<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIuran extends Model
{
    use HasFactory;
    protected $primaryKey = 'pembayaran_iuran_id';
    protected $fillable = [
        'tagihan_bulanan_id',
        'rt_id',
        'user_id',
        'jenis_iuran_id',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
    ];
    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function TagihanBulanans(){
        return $this->belongsTo(TagihanBulanan::class, 'tagihan_bulanan_id');
    }
    public function JenisIuran(){
        return $this->belongsTo(JenisIuran::class, 'jenis_iuran_id');
    }
    public function RT(){
        return $this->belongsTo(RT::class, 'rt_id');
    }

}
