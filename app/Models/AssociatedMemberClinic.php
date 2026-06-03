<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatedMemberClinic extends Model
{
    use HasFactory;
    public $table = 'associated_member_Clinic';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'associated_member_id',
        'clinic_name',
        'address',
        'time',
        'work_day',
        'photo',
        'service_id',
        'sub_service_id',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
    ];
    public function services()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
    public function subservices()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id', 'sub_service_id');
    }

    public function assocmember()
    {
        return $this->belongsTo(AssociatedMember::class, 'associated_member_id', 'id');
    }
}
