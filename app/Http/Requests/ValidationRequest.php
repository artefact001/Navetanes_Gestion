<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EntityRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Règles de validation qui s'appliquent à la demande.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Validation pour la table 'users'
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],

            // Validation pour la table 'equipes'
            'equipe_nom' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image'],
            'date_creer' => ['required', 'date', 'after_or_equal:today'],
            'zone_id' => ['required', 'exists:zones,id'],
            'user_id' => ['nullable', 'exists:users,id'],

            // Validation pour la table 'joueurs'
            'joueur_nom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'licence' => ['required', 'string', 'unique:joueurs,licence'],
            'equipe_id' => ['required', 'exists:equipes,id'],
            'categorie_id' => ['required', 'exists:categories,id'],

            // Validation pour la table 'categories'
            'categorie_nom' => ['required', 'string', 'max:255'],

            // Validation pour la table 'zones'
            'zone_nom' => ['required', 'string', 'max:255'],
            'localite' => ['required', 'string', 'max:255'],
            'zone_user_id' => ['nullable', 'exists:users,id'],

            // Validation pour la table 'competitions'
            'competition_nom' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin' => ['required', 'date', 'after:date_debut'],

            // Validation pour la table 'matchs'
            'equipe_local' => ['required', 'exists:equipes,id'],
            'equipe_visiteur' => ['required', 'exists:equipes,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'lieu' => ['required', 'string', 'max:255'],

            // Validation pour la table 'resultats'
            'match_id' => ['required', 'exists:matchs,id'],
            'carton_jaune' => ['required', 'integer', 'min:0'],
            'carton_rouge' => ['required', 'integer', 'min:0'],
            'detail_but' => ['required', 'json'],
            'score_local' => ['required', 'integer', 'min:0'],
            'score_visiteur' => ['required', 'integer', 'min:0'],

            // Validation pour la table 'tirages'
            'competition_id' => ['required', 'exists:competitions,id'],
            'phase' => ['required', 'json'],
            'poul' => ['required', 'json'],

            // Validation pour la table 'historique_joueur_equipe'
            'joueur_id' => ['required', 'exists:joueurs,id'],
            'equipe_id' => ['required', 'exists:equipes,id'],
            'date_debut' => ['required', 'date', 'before_or_equal:today'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            // Validation pour la table 'notifications'
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'string', 'max:255'],
            'data' => ['required', 'string'],
            'read_at' => ['nullable', 'date'],

            // Validation pour la table 'reclamations'
            'equipe_id' => ['required', 'exists:equipes,id'],
            'description' => ['required', 'string'],
            'statut' => ['required', Rule::in(['en_attente', 'traitee', 'rejete'])],
        ];
    }
}
