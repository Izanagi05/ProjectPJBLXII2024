<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIuran extends Model
{
    use HasFactory;
    protected $primaryKey='jenis_iuran_id';
    protected $fillable=['nama', 'deskripsi', 'jumlah'];
    public function TagihanBulanans(){
        return $this->hasMany(TagihanBulanan::class, 'jenis_iuran_id');
    }
}
