<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    public $table = 'plans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'sequence_no',
        'name',
        'slugname',
        'amount',
        'duration_in_days',
        'no_of_members',
        'terms_and_condition',
        'wallet_balance',
        'plan_image',
        'plan_detail_pdf',
        'plan_detail_image',
        'extra_amount_per_person',
        'extra_amount_per_person_in_wallet',
        'lab_max_applicable_amount_each_time',
        'lab_minimum_order_value',
        'lab_special_terms_and_condition',
        'is_corporate',
        'iStatus',
        'isDelete',
        'strIP',
        'created_at',
        'updated_at'

    ];
}
