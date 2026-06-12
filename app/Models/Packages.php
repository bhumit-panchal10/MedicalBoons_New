<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    public $table = 'Packages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'Price',
        'MRP_Price',
        'Tests',
        'fasting_required',
        'logo',
        'pdf',
        'description',
        'slugname',
        'created_at',
        'updated_at'
    ];
}
