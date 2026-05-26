<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;
    public $table = 'sub_service';
    protected $primaryKey = 'sub_service_id';
    protected $fillable = [
        'sub_service_id',
        'subservice_name',
        'service_id',
        'sub_description',
        'slug_name',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
}
