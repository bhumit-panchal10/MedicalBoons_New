<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    public $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'sequence_no',
        'name',
        'slug_name',
        'photo',
        'description',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];

    public function subservices()
    {
        return $this->hasMany(SubService::class, 'service_id', 'id');
    }
}
