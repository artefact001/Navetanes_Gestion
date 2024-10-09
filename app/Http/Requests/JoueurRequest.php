<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoueurRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'poste' => 'required|string|max:50',
            'equipe_id' => 'required|exists:equipes,id', // Supposant que tu as une table équipes
        ];
    }
}
