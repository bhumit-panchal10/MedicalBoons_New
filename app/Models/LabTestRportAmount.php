<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestRportAmount extends Model
{
    use HasFactory;
    public $table = 'Lab_Test_Report_Amount';
    protected $primaryKey = 'Lab_Test_Report_Amount_id';
    protected $fillable = [
        'Lab_Test_Report_Amount_id',
        'Lab_Master_id',
        'Lab_Test_category_id',
        'Lab_Test_Master_id',
        'MRP',
        'Discount',
        'DiscountAmount',
        'NetAmount',
        'planId',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];

    public function labcategory()
    {
        return $this->belongsTo(LabTestCategory::class, 'Lab_Test_category_id', 'Lab_Test_Category_id');
    }

    public function labtestmaster()
    {
        return $this->belongsTo(LabTestMaster::class, 'Lab_Test_Master_id', 'Lab_Test_Master_id');
    }

    public function labmaster()
    {
        return $this->belongsTo(LabMaster::class, 'Lab_Master_id', 'Lab_Master_id');
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'planId', 'id');
    }
}
