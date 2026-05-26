<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'Customer_id';
    public $table = 'Customer';
    protected $fillable = [
        'Customer_id',
        'Customer_name',
        'Customer_Address',
        'Customerimg',
        'email',
        'city_id',
        'Customer_phone',
        'company_name',
        'hotelhostel_name',
        'role',
        'Gst_no',
        'Pincode',
        'Customer_GUID',
        'password',
        'confirm_password',
        'otp',
        'isOtpVerified',
        'expiry_time',
        'latitude',
        'longitude',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP',

    ];

    public function city()
    {
        return $this->belongsTo(CityMaster::class, 'city_id', 'cityId');
    }

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

    private function sendMessage($msgText)
    {
        $client = new Client();


        try {
            $response = $client->request('GET', $msgText);
            $responseBody = $response->getBody()->getContents();

            return $responseBody;
        } catch (RequestException $e) {
            // Handle error
            // Log::error("Failed to send SMS to {$mobile}: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
