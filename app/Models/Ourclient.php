<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourclient extends Model
{
    use HasFactory;
    public $table = 'our_client';
    protected $primaryKey = 'our_client_id';
    protected $fillable = [
        'our_client_id',
        'image',
        'name',
        'created_at',
        'updated_at'

    ];


    public function labcategory()
    {
        return $this->belongsTo(LabTestCategory::class, 'lab_test_category_id', 'Lab_Test_Category_id');
    }
}
