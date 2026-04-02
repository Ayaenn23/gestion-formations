<!DOCTYPE html>
<html>
<body>
    <h1>Inscription confirmée !</h1>
    <p>Bonjour {{ $enrollment->user->name }},</p>
    <p>Votre inscription <strong>{{ $enrollment->enrollment_ref }}</strong> a été confirmée.</p>
    <p>Formation : {{ $enrollment->trainingSession->formation->titre_fr }}</p>
    <p>Date : {{ $enrollment->trainingSession->start_date }}</p>
</body>
</html>
