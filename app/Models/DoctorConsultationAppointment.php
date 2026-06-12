<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorConsultationAppointment extends Model
{
    use HasFactory;
    public $table = 'doctor_consultation_appointment';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'member_id',
        'family_member_id',
        'service_id',
        'sub_service_id',
        'doctor_id',
        'created_at',
        'updated_at'

    ];
}
