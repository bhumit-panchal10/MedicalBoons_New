<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabReportRequestTemp extends Model
{
    use HasFactory;
    public $table = 'LabReport_Request_temp';
    protected $fillable = [
        'LabReport_Request_temp_id',
        'member_id',
        'family_member_id',
        'lab_test_id',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at'
    ];

    public function labtestmaster()
    {
        return $this->belongsTo(LabTestMaster::class, 'lab_test_id', 'Lab_Test_Master_id');
    }

    public function familymembername()
    {
        return $this->belongsTo(FamilyMember::class, 'family_member_id', 'family_member_id');
    }
}
