<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Utilisateur;

class EntrepreneurApprouve extends Mailable
{
    use Queueable, SerializesModels;
    public $utilisateur; // Cette propriété publique rend l'objet $utilisateur disponible dans la vue de l'email

    /**
     * Crée une nouvelle instance de message.
     *
     * @param  \App\Models\Utilisateur  $utilisateur
     * @return void
     */
    public function __construct(Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * Récupère l'enveloppe du message (sujet de l'email).
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Félicitations ! Votre demande de stand Eat&Drink a été approuvée !',
        );
    }

    /**
     * Récupère la définition du contenu du message (la vue de l'email).
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.entrepreneur.approuve', // Chemin vers la vue Markdown de l'email
        );
    }

    /**
     * Récupère les pièces jointes du message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

}
