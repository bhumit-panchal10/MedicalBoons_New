<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $table = 'Users';
    protected $primaryKey = 'Users_id';
    protected $fillable = [
        'Users_id',
        'company_name',
        'contact_person',
        'mobile',
        'email',
        'Address',
        'Type',
        'Main_parent_id',
        'Parent_id',
        'Guid',
        'link',
        'password',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP'
    ];
}
