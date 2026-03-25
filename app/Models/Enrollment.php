<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trainingSession()
    {
        return $this->belongsTo(TrainingSession::class);
    }

}
