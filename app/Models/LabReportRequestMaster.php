<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabReportRequestMaster extends Model
{
    use HasFactory;
    public $table = 'LabReport_Request_Master';
    protected $fillable = [
        'LabReport_Request_id',
        'Lab_id',
        'date',
        'visit',
        'member_id',
        'family_member_id',
        'lab_test_id',
        'appointments_flag',
        'discount_amount',
        'NetAmount',
        'degree',
        'associated_id',
        'service_id',
        'doctor_id',
        'sub_service_id',
        'type',
        'hospital_name',
        'concern_requirement',
        'time',
        'service_required',
        'Address',
        'member_name',
        'service_Interested',
        'prefered_contact_time',
        'created_at',
        'updated_at'
    ];
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
    public function subservice()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id', 'sub_service_id');
    }
    public function lab()
    {
        return $this->belongsTo(LabMaster::class, 'Lab_id', 'Lab_Master_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function labreqmasterdetail()
    {
        return $this->hasMany(LabReportRequestdetail::class, 'LabReport_Request_Master_id', 'LabReport_Request_id')->with('Test_Name');
    }
    public function family_membername()
    {
        return $this->belongsTo(FamilyMember::class, 'family_member_id', 'family_member_id');
    }
    public function AssociatedMember()
    {
        return $this->belongsTo(AssociatedMember::class, 'associated_id', 'id');
    }
}
