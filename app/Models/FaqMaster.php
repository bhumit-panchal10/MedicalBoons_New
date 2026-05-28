<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqMaster extends Model
{
    use HasFactory;
    public $table = 'faq-masters';
    protected $fillable = [
        'faqid',
        'question',
        'answer',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'strIP',
        'type'
    ];
}
