<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey='admin_id';

    protected $fillable = [
        'user_id',
        'admin_role_id',
    ];

    public function AdminRole(){
        return $this->belongsTo(AdminRole::class, 'admin_role_id', 'admin_role_id');
    }
    public function UserData(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
