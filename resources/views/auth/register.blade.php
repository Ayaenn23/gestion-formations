<x-guest-layout>

    <h1 class="text-xl font-bold text-gray-900 mb-1">Créer un compte</h1>
    <p class="text-sm text-gray-500 mb-6">Rejoignez la plateforme FormaPro.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <x-primary-button class="mt-2">
            Créer le compte
        </x-primary-button>

        <p class="text-center text-sm text-gray-500 mt-4">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Se connecter</a>
        </p>
    </form>

</x-guest-layout>