<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaGroup extends Model
{
    use HasFactory;
    protected $primaryKey='wa_group_id';
    protected $fillable=['group_data_id', 'group_nama','izin', 'rt_id'];
    public function RT(){
        return $this->belongsTo(RT::class, 'rt_id');
    }
}
