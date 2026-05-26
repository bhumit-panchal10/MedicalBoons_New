<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabMaster extends Model
{
    use HasFactory;
    public $table = 'Lab_Master';
    protected $primaryKey = 'Lab_Master_id';
    protected $fillable = [
        'Lab_Master_id',
        'name',
        'address',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];
}
