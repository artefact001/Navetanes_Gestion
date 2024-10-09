<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
{
    /**
     * Déterminer si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Peut être modifié pour limiter l'accès
    }

    /**
     * Règles de validation pour la création/mise à jour d'un match.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'competition_id' => 'required|exists:competitions,id',
            'equipe_local' => 'required|string|max:255',
            'equipe_visiteur' => 'required|string|max:255',
            'score_local' => 'nullable|integer|min:0',
            'score_visiteur' => 'nullable|integer|min:0',
            'date_matche' => 'required|date',
        ];
    }

    /**
     * Messages d'erreurs personnalisés pour les validations.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'competition_id.required' => 'La compétition est requise.',
            'competition_id.exists' => 'La compétition sélectionnée n\'existe pas.',
            'equipe_local.required' => 'Le nom de l\'équipe locale est requis.',
            'equipe_visiteur.required' => 'Le nom de l\'équipe visiteuse est requis.',
            'score_local.integer' => 'Le score de l\'équipe locale doit être un entier.',
            'score_visiteur.integer' => 'Le score de l\'équipe visiteuse doit être un entier.',
            'date_matche.required' => 'La date du matche est requise.',
            'date_matche.date' => 'La date du matche doit être une date valide.',
        ];
    }
}



