<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case EnAttente = 'en attente';
    case Confirmee = 'confirmée';
    case Annulee = 'annulée';
}

