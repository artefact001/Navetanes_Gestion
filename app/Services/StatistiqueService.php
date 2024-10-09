<?php

namespace App\Services;

use App\Models\Statistique;

class StatistiqueService
{
    // Méthode pour créer une nouvelle statistique
    public function createStatistique(array $data)
    {
        return Statistique::create($data);
    }

    // Méthode pour récupérer toutes les statistiques
    public function getAllStatistiques()
    {
        return Statistique::with(['joueur', 'equipe'])->get();
    }

    // Méthode pour récupérer les statistiques d'un joueur
    public function getStatistiquesByJoueur($joueurId)
    {
        return Statistique::where('joueur_id', $joueurId)->with(['equipe'])->get();
    }

    // Méthode pour mettre à jour une statistique existante
    public function updateStatistique($id, array $data)
    {
        $statistique = Statistique::findOrFail($id);
        $statistique->update($data);
        return $statistique;
    }

    // Méthode pour supprimer une statistique
    public function deleteStatistique($id)
    {
        $statistique = Statistique::findOrFail($id);
        $statistique->delete();
        return $statistique;
    }
}
