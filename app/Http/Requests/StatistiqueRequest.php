<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatistiqueRequest extends FormRequest
{
    // Détermine si l'utilisateur est autorisé à faire cette demande
    public function authorize()
    {
        return true; // Autoriser toutes les requêtes pour le moment
    }

    // Règles de validation pour la requête
    public function rules()
    {
        return [
            'joueur_id' => 'required|exists:joueurs,id',
            'equipe_id' => 'required|exists:equipes,id',
            // 'minutes_jouees' => 'required|integer|min:0',
            'buts' => 'required|integer|min:0',
            'passeurs' => 'required|integer|min:0',
            // 'tirs' => 'required|integer|min:0',
            // 'dribbles_reussis' => 'required|integer|min:0',
            // 'interceptions' => 'required|integer|min:0',
            // 'fautes_commises' => 'required|integer|min:0',
            'cartons_jaunes' => 'required|integer|min:0',
            'cartons_rouges' => 'required|integer|min:0',
            // 'distance_parcourue' => 'required|numeric|min:0',
            // 'evaluation' => 'required|numeric|min:0',
        ];
    }
}
