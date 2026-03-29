<?php

namespace App\Enums;

enum FormationStatus: string
{
    case Brouillon = 'brouillon';
    case Publie = 'publié';
    case Archive = 'archivé';
}

