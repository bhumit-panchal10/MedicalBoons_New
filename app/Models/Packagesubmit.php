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

    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function family_member()
    {
        return $this->belongsTo(FamilyMember::class, 'family_member_id', 'family_member_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
