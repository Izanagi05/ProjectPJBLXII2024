<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;
    protected $primaryKey='log_id';

    protected $fillable = [
        'admin_id',
        'activity_type',
        'logged_at',
    ];
    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
