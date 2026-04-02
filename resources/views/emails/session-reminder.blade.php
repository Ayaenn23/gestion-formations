<!DOCTYPE html>
<html>

<body>
    <h1>Rappel de session</h1>
    <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
    <p>Votre session commence dans 2 jours !</p>
    <p><strong>Formation :</strong> {{ $session->formation->titre_fr }}</p>
    <p><strong>Date :</strong> {{ $session->start_date }}</p>
    <p><strong>Mode :</strong> {{ $session->mode->value }}</p>
    @if($session->ville)
    <p><strong>Ville :</strong> {{ $session->ville }}</p>
    @endif
    @if($session->lien_reunion)
    <p><strong>Lien :</strong> {{ $session->lien_reunion }}</p>
    @endif
</body>

</html>