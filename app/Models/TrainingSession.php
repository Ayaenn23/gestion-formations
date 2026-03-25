<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'capacity',
        'mode',
        'ville',
        'lien_reunion',
        'statut',
    ];
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}

