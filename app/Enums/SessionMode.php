<?php

namespace App\Enums;

enum SessionMode: string
{
    case Presentiel = 'présentiel';
    case EnLigne = 'en ligne';
    case Hybride = 'hybride';

}
