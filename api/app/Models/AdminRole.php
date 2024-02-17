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
    ];

    public function Admins(){
        return $this->hasMany(Admin::class, 'admin_id');
    }
}
