<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
    'name_fr',
    'name_en',
    'slug_fr',
    'slug_en',
];

  public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
