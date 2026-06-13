<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packagesubmit extends Model
{
    use HasFactory;
    public $table = 'packages_submit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'member_id',
        'family_member_id',
        'service_id',
        'package_id',
        'date',
        'time_slot',
        'name_sample_collection',
        'note',
        'created_at',
        'updated_at'
    ];
}
