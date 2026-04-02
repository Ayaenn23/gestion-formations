<!DOCTYPE html>
<html>
<body>
    <h1>Inscription annulée</h1>
    <p>Bonjour {{ $enrollment->user->name }},</p>
    <p>Votre inscription <strong>{{ $enrollment->enrollment_ref }}</strong> a été annulée.</p>
    <p>Formation : {{ $enrollment->trainingSession->formation->titre_fr }}</p>
</body>
</html>
