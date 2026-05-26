<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerWithUs extends Model
{
    use HasFactory;
    public $table = 'Partner_With_Us';
    protected $fillable = [
        'id',
        'name',
        'address',
        'mobile',
        'subject',
        'message',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];
}
