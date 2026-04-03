<x-guest-layout>

    <h1 class="text-xl font-bold text-gray-900 mb-1">Connexion</h1>
    <p class="text-sm text-gray-500 mb-6">Accédez à votre espace administration.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                Mot de passe oublié ?
            </a>
            @endif
        </div>

        <x-primary-button class="mt-2">
            Se connecter
        </x-primary-button>

        @if (Route::has('register'))
        <p class="text-center text-sm text-gray-500 mt-4">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">S'inscrire</a>
        </p>
        @endif
    </form>

</x-guest-layout>