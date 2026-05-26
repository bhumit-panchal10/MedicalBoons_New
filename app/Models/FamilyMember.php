<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    public $table = 'family_member';
    protected $primaryKey = 'family_member_id';
    protected $fillable = [
        'family_member_id',
        'member_name',
        'DOB',
        'active_inactive',
        'gender',
        'member_id',
        'discount_apply',
        'created_at',
        'updated_at'

    ];
}
