<?php

namespace App\Services;

use App\Models\Joueur;

class JoueurService
{
    public function recupererTousLesJoueurs()
    {
        return Joueur::all();
    }

    public function creerJoueur(array $data)
    {
        return Joueur::create($data);
    }

    public function recupererJoueurParId(int $id)
    {
        return Joueur::findOrFail($id);
    }

    public function mettreAJourJoueur(Joueur $joueur, array $data)
    {
        $joueur->update($data);
        return $joueur;
    }

    public function supprimerJoueur(Joueur $joueur)
    {
        $joueur->delete();
    }
}
