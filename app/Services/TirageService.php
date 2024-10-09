<?php

namespace App\Services;

use App\Models\Tirage;
use Illuminate\Support\Facades\DB;

class TirageService
{
    /**
     * Créer un tirage.
     *
     * @param array $data
     * @return Tirage
     */
    public function creerTirage(array $data)
    {
        return Tirage::create([
            'phase' => $data['phase'],
            'competition_id' => $data['competition_id'],
            'poules' => $data['poules'],
            'nombre_poules' => $data['nombre_poules'], // Enregistrement du nombre de poules
        ]);
    }

    /**
     * Générer les poules en fonction du nombre spécifié.
     *
     * @param int $nombrePoules
     * @param array $equipes
     * @return array
     */
    public function genererPoules(int $nombrePoules, array $equipes): array
    {
        $poules = [];

        // Mélanger les équipes pour randomiser le tirage
        shuffle($equipes);

        // Calculer le nombre d'équipes par poule
        $equipesParPoule = ceil(count($equipes) / $nombrePoules);

        for ($i = 0; $i < $nombrePoules; $i++) {
            $poules[] = [
                'nom' => 'Poule ' . chr(65 + $i), // 'A', 'B', 'C', ...
                'equipes' => array_slice($equipes, $i * $equipesParPoule, $equipesParPoule),
            ];
        }

        return $poules;
    }
}
