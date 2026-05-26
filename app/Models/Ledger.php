<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    public $table = 'ledger';
    protected $fillable = [
        'Ledger_id',
        'order_id',
        'opening',
        'cr',
        'dr',
        'closing',
        'created_at',
        'updated_at'
    ];
}
