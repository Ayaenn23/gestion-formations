<!DOCTYPE html>
<html>
<body>
    <h1>Nouveau message de contact</h1>
    <p><strong>Nom :</strong> {{ $contact->name }}</p>
    <p><strong>Email :</strong> {{ $contact->email }}</p>
    <p><strong>Téléphone :</strong> {{ $contact->phone ?? 'Non renseigné' }}</p>
    <p><strong>Sujet :</strong> {{ $contact->subject }}</p>
    <p><strong>Message :</strong> {{ $contact->message }}</p>
</body>
</html>
