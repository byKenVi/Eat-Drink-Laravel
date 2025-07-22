<x-mail::message>
# Félicitations, {{ $utilisateur->prenom }} !

Nous avons le plaisir de vous informer que votre demande de création de stand sur la plateforme Eat&Drink a été *approuvée* !

Votre stand est maintenant actif et prêt à accueillir vos produits.

Vous pouvez dès à présent vous connecter à votre tableau de bord entrepreneur pour :
* Ajouter et gérer vos produits.
* Gérer les informations de votre stand.
* Consulter vos commandes.

@component('mail::button', ['url' => url('/login')]) {{-- Assurez-vous que l'URL de login est correcte --}}
Accéder à votre Tableau de Bord Eat&Drink
@endcomponent

Nous sommes ravis de vous compter parmi nos partenaires et nous avons hâte de voir vos délicieux produits sur notre plateforme !

Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter.

Merci,<br>
L'équipe de Eat&Drink
</x-mail::message>