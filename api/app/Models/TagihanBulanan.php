<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanBulanan extends Model
{
    use HasFactory;
    protected $primaryKey='tagihan_bulanan_id';
    protected $fillable = [
        'user_id',
        'tahun_id',
        'bulan_id',
        'jenis_iuran_id',
        'status_pembayaran',
    ];
    public function PembayaranIurans(){
        return $this->hasMany(PembayaranIuran::class, 'tagihan_bulanan_id');
    }
    public function JenisIuran(){
        return $this->belongsTo(JenisIuran::class, 'jenis_iuran_id');
    }
    public function Tahun(){
        return $this->belongsTo(Tahun::class, 'tahun_id');
    }
    public function Bulan(){
        return $this->belongsTo(Bulan::class, 'bulan_id');
    }
}
