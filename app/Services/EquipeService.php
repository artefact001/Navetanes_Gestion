<?php

namespace App\Services;

use App\Models\Equipe;
use Illuminate\Support\Facades\Log;

class EquipeService
{
    /**
     * Créer une nouvelle équipe.
     *
     * @param array $data Les données de la nouvelle équipe
     * @return Equipe
     */
    public function creerEquipe(array $data)
    {
        try {
            return Equipe::create($data);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'une équipe : ' . $e->getMessage());
            throw new \Exception('Erreur lors de la création de l\'équipe.');
        }
    }

    /**
     * Mettre à jour une équipe existante.
     *
     * @param Equipe $equipe L'équipe à mettre à jour
     * @param array $data Les nouvelles données
     * @return Equipe
     */
    public function mettreAJourEquipe(Equipe $equipe, array $data)
    {
        try {
            $equipe->update($data);
            return $equipe;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'équipe : ' . $e->getMessage());
            throw new \Exception('Erreur lors de la mise à jour de l\'équipe.');
        }
    }

    /**
     * Supprimer une équipe.
     *
     * @param Equipe $equipe L'équipe à supprimer
     * @return void
     */
    public function supprimerEquipe(Equipe $equipe)
    {
        try {
            $equipe->delete();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'équipe : ' . $e->getMessage());
            throw new \Exception('Erreur lors de la suppression de l\'équipe.');
        }
    }

    /**
     * Récupérer une équipe par son identifiant.
     *
     * @param int $id L'identifiant de l'équipe
     * @return Equipe
     */
    public function recupererEquipeParId(int $id)
    {
        return Equipe::findOrFail($id);
    }

    /**
     * Récupérer toutes les équipes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recupererToutesLesEquipes()
    {
        return Equipe::all();
    }
}
