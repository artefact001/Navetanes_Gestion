<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
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
     * Règles de validation pour la création/mise à jour d'une compétition.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
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
            'nom.required' => 'Le nom de la compétition est requis.',
            'lieu.required' => 'Le lieu de la compétition est requis.',
            'date_debut.required' => 'La date de début est requise.',
            'date_fin.required' => 'La date de fin est requise.',
            'date_fin.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
        ];
    }
}
