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

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div>
            <h2 class="text-3xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-blue-600 mb-6">
                Créer un compte Eat&amp;Drink
            </h2>
        </div>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nom complet -->
            <div>
                <x-input-label for="name" :value="__('Nom complet')" />
                <x-text-input bg-white id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input bg-white id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Nom de l'entreprise -->
            <div>
                <x-input-label for="nom_entreprise" :value="__('Nom de l\'entreprise')" />
                <x-text-input id="nom_entreprise" class="block mt-1 w-full" type="text" name="nom_entreprise" :value="old('nom_entreprise')" required />
            </div>

            <!-- Motivation -->
            <div>
                <x-input-label for="motivation" :value="__('Pourquoi voulez-vous un stand ?')" />
                <textarea id="motivation" name="motivation" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('motivation') }}</textarea>
            </div>

            <!-- Mot de passe -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-blue-600" href="{{ route('login') }}">
                    {{ __('Déjà inscrit ? Se connecter') }}
                </a>
                <button type="submit" class="ml-4 px-6 py-2 rounded-lg font-semibold bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white shadow">
                    {{ __('S\'inscrire') }}
                </button>
            </div>
        </form>
    </div>
</div>
