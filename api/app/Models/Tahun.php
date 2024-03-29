<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $primaryKey='tahun_id';
    protected $fillable=['tahun'];
    public function TagihanBulanans(){
        return $this->hasMany(TagihanBulanan::class, 'tahun_id');
    }
}
