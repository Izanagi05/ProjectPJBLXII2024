<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlamat extends Model
{
    use HasFactory;
    protected $primaryKey='detail_alamat_id';
    protected $fillable=['nama','alamat_id'];
    public function Alamat(){
        return $this->belongsTo(Alamat::class, 'alamat_id');
    }
    public function Wargas(){
        return $this->belongsToMany(User::class,'user_alamats','detail_alamat_id', 'user_id');
    }
}
