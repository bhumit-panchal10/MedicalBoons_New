<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;
    public $table = 'plan_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'plan_id',
        'service_id',
        'sub_service_id',
        'service_description',
        'amount',
        'discount',
        'valuation',
        'extra_amount',
        'session_count',
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
