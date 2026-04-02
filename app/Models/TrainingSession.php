<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\SessionMode;

class TrainingSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'trainer_id',
        'start_date',
        'end_date',
        'capacity',
        'mode',
        'ville',
        'lien_reunion',
        'statut',
    ];

    protected $casts = [
        'mode' => SessionMode::class,
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
