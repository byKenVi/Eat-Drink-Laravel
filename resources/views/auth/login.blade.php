<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Eat & Drink - Événement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>


<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-300 via-green-400 to-blue-400 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white rounded-xl shadow-lg p-8">
        <div>
            <h2 class="text-3xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-blue-600 mb-6">
                Connexion Eat&amp;Drink
            </h2>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input bg-white id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input bg-white id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-blue-600" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-blue-600" href="{{ route('register') }}">
                    {{ __('Créer un compte') }}
                </a>
                <button type="submit" class="ml-4 px-6 py-2 rounded-lg font-semibold bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white shadow">
                    {{ __('Se connecter') }}
                </button>
            </div>
        </form>
    </div>
</div>
