<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOrder extends Model
{
    use HasFactory;
    protected $table = 'Member_Order';
    protected $primaryKey = 'Member_Order_id';
    protected $fillable = [
        'Member_Order_id',
        'Member_id',
        'Order_id',
        'created_at',
        'updated_at'


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
