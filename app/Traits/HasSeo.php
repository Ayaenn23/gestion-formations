<?php

namespace App\Traits;

trait HasSeo
{
   public function getSeoTitle(string $locale = 'fr'): string
{
    $field = 'seo_title_' . $locale;
    $titleField = 'titre_' . $locale;
    $titleFieldAlt = 'title_' . $locale;
    $nameField = 'name_' . $locale;

    return $this->$field
        ?? $this->$titleField
        ?? $this->$titleFieldAlt
        ?? $this->$nameField
        ?? '';
}
}
