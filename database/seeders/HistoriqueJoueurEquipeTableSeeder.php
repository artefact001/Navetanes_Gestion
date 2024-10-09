<?php

use Illuminate\Database\Seeder;
use App\Models\HistoriqueJoueurEquipe;
use App\Models\Joueur;
use App\Models\Equipe;

class HistoriqueJoueurEquipeTableSeeder extends Seeder
{
    public function run()
    {
        HistoriqueJoueurEquipe::truncate(); // Optionnel : Pour vider la table avant de remplir

        $joueurs = Joueur::all();
        $equipes = Equipe::all();

        // Vérifiez qu'il y a des joueurs et des équipes
        if ($joueurs->isEmpty() || $equipes->isEmpty()) {
            $this->command->error('Aucun joueur ou équipe disponible pour créer l\'historique.');
            return;
        }

        $historiqueData = [];

        foreach ($joueurs as $joueur) {
            // Générer des dates aléatoires
            $dateDebut = now()->subMonths(rand(1, 12));
            $dateFin = now(); // Ou utilisez une date ultérieure si nécessaire

            $historiqueData[] = [
                'joueur_id' => $joueur->id,
                'equipe_id' => $equipes->random()->id,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
            ];
        }

        // Insérer les historiques en une seule requête
        HistoriqueJoueurEquipe::insert($historiqueData);
    }
}
