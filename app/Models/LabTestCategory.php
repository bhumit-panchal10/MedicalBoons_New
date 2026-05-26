<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestCategory extends Model
{
    use HasFactory;
    public $table = 'Lab_Test_Category';
    protected $primaryKey = 'Lab_Test_Category_id';
    protected $fillable = [
        'Lab_Test_Category_id',
        'name',
        'display_priority',
        'description',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];
}
