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
    public function Alamats(){
        return $this->hasMany(Alamat::class, 'rt_id');
    }
    public function Pembayarans(){
        return $this->hasMany(PembayaranIuran::class, 'rt_id');
    }
}
