<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatedMember extends Model
{
    use HasFactory;
    public $table = 'associated_members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'service_id',
        'sub_service_id',
        'dr_name',
        'degree',
        'address_1',
        'address_2',
        'about_dr_or_clinic',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP'


    ];
    public function subservices()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id', 'sub_service_id');
    }

}
