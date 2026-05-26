<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabReportRequestdetail extends Model
{
    use HasFactory;
    public $table = 'LabReport_Request_detail';
    protected $fillable = [
        'LabReport_Request_detail_id',
        'LabReport_Request_Master_id',
        'member_id',
        'family_member_id',
        'Lab_test_master_id',
        'Lab_test_category_id',
        'created_at',
        'updated_at'
    ];

    public function family_member()
    {
        return $this->belongsTo(FamilyMember::class, 'family_member_id', 'family_member_id');
    }

    public function Test_Name()
    {
        return $this->belongsTo(LabTestMaster::class, 'Lab_test_master_id', 'Lab_Test_Master_id');
    }

    public function LabTest_Catgory_Name()
    {
        return $this->belongsTo(LabTestCategory::class, 'Lab_test_category_id', 'Lab_Test_Category_id');
    }

    public function master()
    {
        return $this->belongsTo(LabReportRequestMaster::class, 'LabReport_Request_Master_id', 'LabReport_Request_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function LabTestRportAmount()
    {
        return $this->belongsTo(LabTestRportAmount::class, 'Lab_test_master_id', 'Lab_Test_Master_id');
    }
}
