<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TirageRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Autoriser tous les utilisateurs pour l'instant
    }

    /**
     * Obtenir les règles de validation pour la requête.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phase' => 'required|string|max:255', // Validation pour la phase
            'competition_id' => 'required|exists:competitions,id', // Validation pour l'ID de la compétition
            'poules' => 'nullable|json', // Validation pour les poules (optionnel)
            'nombre_poules' => 'required|integer|min:1', // Validation pour le nombre de poules
        ];
    }
}
