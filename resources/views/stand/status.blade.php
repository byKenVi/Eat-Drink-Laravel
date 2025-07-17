<x-app-layout>
    <h2>Statut de votre demande de stand</h2>

    @if ($status === 'pending')
        <p>Votre demande est en attente de validation par un administrateur.</p>
    @elseif ($status === 'approved')
        <p>Votre compte a été approuvé ! Accédez à votre tableau de bord.</p>
        <a href="{{ route('entrepreneur.dashboard') }}">Mon tableau de bord</a>
    @endif
</x-app-layout>
