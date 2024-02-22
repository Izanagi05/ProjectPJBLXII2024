<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    use HasFactory;
    protected $table = 'bulans';
    protected $primaryKey = 'bulan_id';
    protected $fillable = ['nama'];
    public function TagihanBulanans(){
        return $this->hasMany(TagihanBulanan::class, 'bulan_id');
    }
}
