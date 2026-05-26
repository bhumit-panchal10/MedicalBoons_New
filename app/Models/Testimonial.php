<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    public $table = 'Testimonial';
    protected $primaryKey = 'Testimonial_id';
    protected $fillable = [
        'Testimonial_id',
        'name',
        'photo',
        'comment',
        'created_at',
        'updated_at'

    ];
}
