<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $table = 'banner';
    protected $fillable = [
        'id',
        'image',
        'title',
        'created_at',
        'updated_at'
    ];
}
