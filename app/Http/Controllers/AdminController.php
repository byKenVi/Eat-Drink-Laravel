<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur; 
use App\Models\Stand;  
use App\Models\Commande; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EntrepreneurApprouve;

class AdminController extends Controller
{
   
    public function dashboard()
    {
        // 1. Lister les demandes de stand en attente
        $demandesEnAttente = User::where('role', 'entrepreneur')->where('status', 'pending')->get();

        // 2.Afficher des commandes passées
        $commandesParStand = Commande::with('stand', 'utilisateur')
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->groupBy('stand.nom_stand');

        return view('admin.dashboard', compact('demandesEnAttente', 'commandesParStand'));
    }

    public function approuverDemande(User $utilisateur)
    {

        // Utilisation d'une transaction pour s'assurer que toutes les opérations réussissent ou échouent ensemble
        DB::transaction(function () use ($utilisateur) {
            // Mise à jour du rôle de l'utilisateur
            $utilisateur->update(['status' => 'entrepreneur_approuve']);
            if (!$utilisateur->stand) {
                StandRequest::create([
                    'utilisateur_id' => $utilisateur->id,
                    'nom_stand' => $utilisateur->nom_entreprise ?: 'Stand de ' . $utilisateur->prenom . ' ' . $utilisateur->nom,
                    'description' => 'Bienvenue sur le stand de ' . ($utilisateur->nom_entreprise ?: $utilisateur->nom) . ' !',
                ]);
            }
        });

        // Envoi de l'email de confirmation
        try {
            Mail::to($utilisateur->email)->send(new EntrepreneurApprouve($utilisateur));
        } catch (\Exception $e) {
            \Log::error("Erreur lors de l'envoi de l'email d'approbation à {$utilisateur->email}: " . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('warning', 'La demande de ' . $utilisateur->nom_entreprise . ' a été approuvée, mais l\'email n\'a pas pu être envoyé.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'La demande de ' . $utilisateur->nom_entreprise . ' a été approuvée avec succès et un stand a été créé. Un email a été envoyé.');
    }

    public function rejeterDemande(Request $request, User $utilisateur)
    {

        // Validation du motif de rejet 
        $request->validate([
            'motif_rejet' => 'string|min:10|max:500', 
        ], [
            'motif_rejet.string' => 'Le motif de rejet doit être une chaîne de caractères.',
            'motif_rejet.min' => 'Le motif de rejet doit contenir au moins 10 caractères.',
            'motif_rejet.max' => 'Le motif de rejet ne doit pas dépasser 500 caractères.',
        ]);

        $motifRejet = $request->input('motif_rejet');

        // Mise à jour du rôle de l'utilisateur et enregistrement du motif de rejet
        $utilisateur->update([
            'role' => 'entrepreneur_rejete', 
            'motif_rejet' => $motifRejet,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'La demande de ' . $utilisateur->nom_entreprise . ' a été rejetée avec succès. Motif enregistré.');
    }
}

