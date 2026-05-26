<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestMaster extends Model
{
    use HasFactory;
    public $table = 'Lab_Test_Master';
    protected $primaryKey = 'Lab_Test_Master_id';
    protected $fillable = [
        'Lab_Test_Master_id',
        'Test_Name',
        'lab_test_category_id',
        'MRP',
        'image',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];


    public function labcategory()
    {
        return $this->belongsTo(LabTestCategory::class, 'lab_test_category_id', 'Lab_Test_Category_id');
    }
}
