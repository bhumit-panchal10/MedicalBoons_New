<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'iOrderId';
    protected $fillable = [
        'iOrderId',
        'iCustomerId',
        'iAmount',
        'iDiscount',
        'iNetAmount',
        'isPayment',
        'isDispatched',
        'isDispatchedBy',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP',
        'payment_mode',
        'start_otp',
        'end_otp',
        'Customer_name',
        'Customer_phone',
        'Customer_Address',
        'Pincode',
        'order_status',
        'order_date',
        'start_otp',
        'end_otp',
        'start_work',
        'slot_id',
        'Technicial_id'

    ];
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class, 'iOrderId', 'iOrderId');
    }
    public function slot()
    {
        return $this->belongsTo(Timeslot::class, 'slot_id', 'Time_slot_id');
    }
}
