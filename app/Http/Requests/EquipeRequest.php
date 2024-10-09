<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipeRequest extends FormRequest
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
     * Règles de validation pour la création/mise à jour d'une équipe.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'stade' => 'nullable|string|max:255',
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
            'nom.required' => 'Le nom de l\'équipe est requis.',
            'ville.required' => 'La ville de l\'équipe est requise.',
        ];
    }
}
