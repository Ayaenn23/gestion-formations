<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre_fr',
        'titre_en',
        'slug_fr',
        'slug_en',
        'description_courte_fr',
        'description_courte_en',
        'description_complete_fr',
        'description_complete_en',
        'image',
        'prix',
        'duree',
        'niveau',
        'statut',
        'date_publication',
        'seo_title_fr',
        'seo_title_en',
        'seo_description_fr',
        'seo_description_en',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class);
    }
}
