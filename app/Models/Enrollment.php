<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EnrollmentStatus;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'statut',
        'enrollment_ref',
        'note',
        'confirmation_date',
        'cancellation_date',
    ];

     protected $casts = [
        'statut' => EnrollmentStatus::class,
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trainingSession()
    {
        return $this->belongsTo(TrainingSession::class);
    }

}
