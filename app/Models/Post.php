<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_fr',
        'title_en',
        'slug_fr',
        'slug_en',
        'content_fr',
        'content_en',
        'image',
        'statut',
        'date_publication',
        'seo_title_fr',
        'seo_title_en',
        'seo_description_fr',
        'seo_description_en',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
