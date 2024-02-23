<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $primaryKey = 'alamat_id';

    protected $fillable = [
        'nama',
        'rt_id',
    ];

    public function DetailAlamats(){
        return $this->hasMany(DetailAlamat::class, 'alamat_id');
    }
    public function Users(){
        return $this->belongsToMany(User::class,'user_alamats', 'alamat_id', 'user_id')->where('role', 'User'); ;
    }
    public function RT(){
        return $this->belongsTo(RT::class, 'rt_id');
    }

}
