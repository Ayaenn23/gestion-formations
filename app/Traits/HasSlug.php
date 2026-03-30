<?php

namespace App\Traits;

trait HasSlug
{
    protected static function bootHasSlug()
{
    static::creating(function ($model) {
        $model->slug_fr = \Str::slug($model->name_fr ?? $model->titre_fr ?? $model->title_fr);
        $model->slug_en = \Str::slug($model->name_en ?? $model->titre_en ?? $model->title_en);
    });
}
}
