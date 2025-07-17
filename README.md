# Eat&Drink – Plateforme de gestion d’événement
Eat&Drink est une application Laravel permettant la gestion d’événements avec plusieurs profils utilisateurs : administrateurs, entrepreneurs et participants. Elle gère l’inscription, la demande de stand, l’approbation par l’admin, et la gestion des accès selon le rôle stocké en base.

# Fonctionnalités principales
Inscription des entrepreneurs avec demande de stand (motivation)
Attribution automatique du rôle entrepreneur et du statut pending à l’inscription
Validation de la demande par un administrateur (changement du statut en approved)
Gestion des participants et de leur dashboard
Création manuelle des administrateurs (via seeder)
Authentification sécurisée (connexion, déconnexion, mot de passe oublié)
Redirection automatique selon le rôle après connexion
Page de suivi du statut de la demande de stand


# Installer les dépendances
composer install
npm install && npm run build
# Configurer l’environnement

Copier .env.example en .env et adapter les variables (DB, mail, etc.)
Générer la clé d’application :
php artisan key:generate

Lancer les migrations et seeders
php artisan migrate --seed

Cela crée un administrateur par défaut.

Démarrer le serveur
php artisan serve

# Utilisation
Inscription entrepreneur : formulaire avec nom, email, motivation, mot de passe. Le compte est créé avec le rôle entrepreneur et le statut pending.
Approbation admin : l’admin change le statut de l’utilisateur à approved (via interface ou script).
Dashboard : chaque utilisateur est redirigé vers son dashboard selon son rôle après connexion.
Statut de la demande : accessible pour les entrepreneurs en attente.
# Gestion des rôles
Les rôles sont gérés via la colonne role de la table users (admin, entrepreneur, participant).
Les statuts (pending, approved) permettent de gérer l’accès aux fonctionnalités pour les entrepreneurs.
Les routes sont protégées par le middleware auth et des vérifications de rôle dans les contrôleurs ou les vues.
Structure des dossiers
Auth : Contrôleurs d’authentification et d’inscription
User.php : Modèle User avec les champs role et status
AdminSeeder.php : Création d’un administrateur par défaut
views : Vues Blade pour chaque dashboard et la page de statut
web.php : Définition des routes protégées
Sécurité
Les accès sont strictement contrôlés par le middleware auth et des vérifications de rôle.
Les mots de passe sont hashés.

# Identifiant amin
'email' = 'admin@mail.fr'
'name' => 'Admin
'password' => Hash::make('password'), 
'role' => 'admin', 