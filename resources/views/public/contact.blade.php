@extends('layouts.public')

@section('content')

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">
            {{ active_locale() === 'fr' ? 'Contactez-nous' : 'Contact us' }}
        </h1>
        <p class="text-gray-500 text-sm">
            {{ active_locale() === 'fr' ? 'Notre équipe vous répond dans les 24h.' : 'Our team replies within 24h.' }}
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-3 gap-10">

        {{-- Form --}}
        <div class="col-span-2">

            <div id="success-msg" style="display:none"
                 class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg flex items-center gap-2">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span></span>
            </div>
            <div id="error-msg" style="display:none"
                 class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg"></div>

            <form id="contact-form" class="bg-white border border-gray-200 rounded-xl p-8 space-y-5 shadow-sm">
                @csrf

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ active_locale() === 'fr' ? 'Nom complet' : 'Full name' }} <span class="text-red-500">*</span>
                        </label>
                        <input id="contact_name" type="text" name="name" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ active_locale() === 'fr' ? 'Téléphone' : 'Phone' }}
                        </label>
                        <input id="contact_phone" type="text" name="phone"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input id="contact_email" type="email" name="email" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label for="contact_subject" class="block text-sm font-medium text-gray-700 mb-1.5">
                        {{ active_locale() === 'fr' ? 'Sujet' : 'Subject' }} <span class="text-red-500">*</span>
                    </label>
                    <input id="contact_subject" type="text" name="subject" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label for="contact_message" class="block text-sm font-medium text-gray-700 mb-1.5">
                        {{ active_locale() === 'fr' ? 'Message' : 'Message' }} <span class="text-red-500">*</span>
                    </label>
                    <textarea id="contact_message" name="message" rows="6" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"></textarea>
                </div>

                <button type="submit" id="submit-btn"
                        class="w-full bg-blue-600 text-white font-semibold px-4 py-3 rounded-lg text-sm hover:bg-blue-700 disabled:opacity-50 transition">
                    {{ active_locale() === 'fr' ? 'Envoyer le message' : 'Send message' }}
                </button>
            </form>
        </div>

        {{-- Infos --}}
        <div class="space-y-5">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <p class="text-sm font-bold text-gray-800 mb-4">
                    {{ active_locale() === 'fr' ? 'Informations de contact' : 'Contact information' }}
                </p>
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="flex items-start gap-3">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" class="text-blue-500 flex-shrink-0 mt-0.5"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>contact@formapro.ma</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" class="text-blue-500 flex-shrink-0 mt-0.5"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>+212 5XX-XXXXXX</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" class="text-blue-500 flex-shrink-0 mt-0.5"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor" stroke-width="2"/></svg>
                        <span>Casablanca, Maroc</span>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 text-sm text-blue-800">
                <p class="font-semibold mb-1">{{ active_locale() === 'fr' ? 'Réponse rapide' : 'Quick reply' }}</p>
                <p class="text-blue-600 text-xs">{{ active_locale() === 'fr' ? 'Nous répondons en moins de 24h ouvrables.' : 'We reply within 24 business hours.' }}</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const btn = document.getElementById('submit-btn');
    const successMsg = document.getElementById('success-msg');
    const errorMsg = document.getElementById('error-msg');

    btn.disabled = true;
    successMsg.style.display = 'none';
    errorMsg.style.display = 'none';

    fetch('{{ route('public.contact.store', ['locale' => active_locale()]) }}', {
        method: 'POST',
        body: new FormData(this),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            successMsg.style.display = 'flex';
            successMsg.querySelector('span').textContent = data.message;
            document.getElementById('contact-form').reset();
        } else {
            errorMsg.style.display = 'block';
            errorMsg.textContent = '{{ active_locale() === "fr" ? "Une erreur est survenue." : "An error occurred." }}';
        }
    })
    .catch(() => {
        errorMsg.style.display = 'block';
        errorMsg.textContent = '{{ active_locale() === "fr" ? "Une erreur est survenue." : "An error occurred." }}';
    })
    .finally(() => { btn.disabled = false; });
});
</script>

@endsection
