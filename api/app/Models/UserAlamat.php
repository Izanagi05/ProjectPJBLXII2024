<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlamat extends Model
{
    use HasFactory;
    protected $primaryKey='user_alamat_id';
    protected $fillable=['user_id', 'alamat_id','detail_alamat_id'];

    // public function DetailAlamat(){
    //     return $this->belongsTo(DetailAlamat::class, 'detail_alamat_id');
    // }
        public function Alamat(){
            return $this->belongsTo(Alamat::class, 'alamat_id');
        }
}
