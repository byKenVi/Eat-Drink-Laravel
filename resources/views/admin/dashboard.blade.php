<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin - Eat&Drink</title>
    {{-- Liens CSS ou inclure votre fichier app.css si vous le compilez --}}
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h1>Tableau de Bord Administrateur</h1>
        <nav>
            <form action="{{ route('Logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </nav>
    </div>

    <div class="container">
        <h2>Gestion des Demandes et Vue d'Ensemble</h2>

        {{-- Affichage des messages de session (succès, erreur, avertissement) --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        {{-- Affichage des erreurs de validation du motif de rejet --}}
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>Demandes de Stands en Attente</h3>
        @if($demandesEnAttente->isEmpty())
            <div class="no-data-message">
                <p>Aucune demande de stand en attente pour le moment.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nom Entreprise</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Date de Demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandesEnAttente as $utilisateur)
                        <tr>
                            <td>{{ $utilisateur->nom_entreprise }}</td>
                            <td>{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>{{ $utilisateur->created_at->format('d/m/Y H:i') }}</td>
                            <td class="action-buttons">
                                {{-- Bouton Approuver --}}
                                <form action="{{ route('admin.approuver_demande', ['utilisateur' => $utilisateur->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="approve-btn" onclick="return confirm('Confirmez-vous l\'approbation de cette demande ?');">Approuver</button>
                                </form>
                                {{-- Bouton Rejeter (ouvre la modale) --}}
                                <button type="button" class="reject-btn" onclick="openRejectModal({{ $utilisateur->id }}, '{{ $utilisateur->nom_entreprise }}');">Rejeter</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Section Commandes Passées (Bonus pour une vue d'ensemble admin) --}}
        <h3>Aperçu des Commandes Passées</h3>
        @if($commandesParStand->isEmpty())
            <div class="no-data-message">
                <p>Aucune commande enregistrée pour le moment.</p>
            </div>
        @else
            @foreach($commandesParStand as $nomStand => $commandes)
                <h4>Stand : {{ $nomStand }}</h4>
                <table>
                    <thead>
                        <tr>
                            <th>ID Commande</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td>#{{ $commande->id }}</td>
                                <td>{{ $commande->utilisateur->prenom ?? 'N/A' }} {{ $commande->utilisateur->nom ?? 'N/A' }}</td>
                                <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $commande->details_commande }}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br> {{-- Petite marge entre les tableaux de stands --}}
            @endforeach
        @endif

    </div>

    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeRejectModal()">&times;</span>
            <h2>Rejeter la demande de stand</h2>
            <p>Veuillez indiquer un motif de rejet clair et concis pour la demande de <strong id="modalEntrepreneurName"></strong> :</p>
            <form id="rejectForm" method="POST">
                @csrf
                <textarea name="motif_rejet" rows="4" placeholder="Ex: Informations manquantes, non-conformité avec nos critères..." required></textarea>
                {{-- Un champ caché pour passer l'ID de l'utilisateur à rejeter --}}
                <input type="hidden" name="utilisateur_id" id="modalUtilisateurId">
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeRejectModal()">Annuler</button>
                    <button type="submit" class="approve-btn" style="background-color:#dc3545;">Confirmer le Rejet</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentUtilisateurId = null;

        // Fonction pour ouvrir la modale de rejet
        function openRejectModal(utilisateurId, nomEntreprise) {
            currentUtilisateurId = utilisateurId;
            document.getElementById('modalEntrepreneurName').innerText = nomEntreprise;
            document.getElementById('modalUtilisateurId').value = utilisateurId;
            // Mettre à jour l'action du formulaire dans la modale avec l'ID de l'utilisateur
            document.getElementById('rejectForm').action = /admin/demandes/${utilisateurId}/rejeter;
            document.getElementById('rejectModal').style.display = 'block';
        }

        // Fonction pour fermer la modale de rejet
        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
            // Optionnel : Réinitialiser le champ texte lors de la fermeture
            document.querySelector('#rejectModal textarea[name="motif_rejet"]').value = '';
        }

        // Fermer la modale si l'utilisateur clique en dehors de son contenu
        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target === modal) {
                closeRejectModal();
            }
        }
    </script>
</body>
</html>