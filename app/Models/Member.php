<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Member extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'mobile',
        'state',
        'city',
        'address',
        'pincode',
        'password',
        'iStatus',
        'otp',
        'expiry_time',
        'Order_id',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP'


    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = [
        'password'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'member_id', 'id');
    }
}
