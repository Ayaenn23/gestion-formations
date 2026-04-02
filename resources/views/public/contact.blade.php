@extends('layouts.public')
@section('content')
    <h1>Contact</h1>

    <div id="success-message" style="display:none; color:green"></div>
    <div id="error-message" style="display:none; color:red"></div>

    <form id="contact-form">
        @csrf
        <div><label>Nom</label><input type="text" name="name"></div>
        <div><label>Email</label><input type="email" name="email"></div>
        <div><label>Téléphone</label><input type="text" name="phone"></div>
        <div><label>Sujet</label><input type="text" name="subject"></div>
        <div><label>Message</label><textarea name="message"></textarea></div>
        <button type="submit">Envoyer</button>
    </form>

    <script>
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route('public.contact.store', ['locale' => active_locale()]) }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('success-message').style.display = 'block';
                    document.getElementById('success-message').innerText = data.message;
                    document.getElementById('contact-form').reset();
                }
            })
            .catch(() => {
                document.getElementById('error-message').style.display = 'block';
                document.getElementById('error-message').innerText = 'Une erreur est survenue.';
            });
        });
    </script>
@endsection
