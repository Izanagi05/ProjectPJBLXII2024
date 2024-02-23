<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey='user_id';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'jenis_kelamin',
        'nik',
        'no_kk',
        'foto_profil',
        'foto_ktp',
        'foto_kk',
        'provinsi_lahir_id',
        'tempat_lahir_lainnya',
        'tgl_lahir',
        'no_telp',
        'email',
        'hubungan',
        'pekerjaan',
        'status_berktp',
        'status_perkawinan',
        'agama_id',
        'role',

    ];

    public function UserProvinsi(){
        return $this->hasOne(Provinsi::class, 'provinsi_id', 'provinsi_lahir_id');
    }
    public function Agama(){
        return $this->belongsTo(Agama::class, 'agama_id');

    }

    public function DetailAlamats(){
        return $this->belongsToMany(DetailAlamat::class, 'user_alamats', 'user_id', 'detail_alamat_id');
    }
    public function UserAlamats(){
        return $this->hasMany(UserAlamat::class, 'user_id');

    }
    public function UserLaporans(){
        return $this->hasMany(Laporan::class, 'user_id');

    }
    public function TagihanBulanans(){
        return $this->hasMany(TagihanBulanan::class, 'user_id');
    }
    public function AdminData(){
        return $this->hasOne(Admin::class, 'user_id',);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
