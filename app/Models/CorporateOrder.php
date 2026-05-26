<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateOrder extends Model
{
    use HasFactory;
    protected $table = 'Corporate_Order';
    protected $primaryKey = 'Corporate_Order_id';
    protected $fillable = [
        'Corporate_Order_id',
        'iUserId',
        'Guid',
        'iOrderType',
        'no_of_member',
        'iPlanId',
        'iExtraMember',
        'iamountExtraMember',
        'iPlanMembers',
        'iExtraMemberAmount',
        'PlanAmount',
        'NetAmount',
        'start_date',
        'end_date',
        'main_parent_id',
        'parent_id',
        'is_corporate',
        'Name',
        'email',
        'mobile',
        'address',
        'state',
        'city',
        'pincode',
        'memberid',
        'isPayment',
        'invoice_no',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP'


    ];
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'iPlanId', 'id');
    }
    public function companyname()
    {
        return $this->belongsTo(Users::class, 'iUserId', 'Users_id');
    }
    public function MainParent()
    {
        return $this->belongsTo(Users::class, 'main_parent_id', 'Users_id');
    }
    public function Parent()
    {
        return $this->belongsTo(Users::class, 'parent_id', 'Users_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid', 'id');
    }
}
