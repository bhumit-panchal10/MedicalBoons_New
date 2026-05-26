<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetail';
    protected $primaryKey = 'iOrderDetailId';
    protected $fillable = [
        'iOrderDetailId',
        'iOrderId',
        'iCustomerId',
        'category_id',
        'Ratecard_id',
        'qty',
        'rate',
        'amount',
        'subcategory_id',
        'isRefund',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP'

    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'Categories_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class, 'subcategory_id', 'iSubCategoryId');
    }
}
