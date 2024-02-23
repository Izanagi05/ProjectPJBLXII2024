<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    protected $primaryKey='admin_role_id';
    protected $fillable = [
        'nama',
        'rt_id',
    ];

    public function Admins(){
        return $this->hasMany(Admin::class, 'admin_id');
    }
    public function RT(){
        return $this->belongsTo(RT::class, 'rt_id');
    }
}
