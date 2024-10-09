<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'match_id' => 'required|exists:matchs,id',
            'equipe_id' => 'required|exists:equipes,id',
            'score' => 'required|integer|min:0',
            'is_winner' => 'required|boolean',
            'buteurs' => 'nullable|array',
            'buteurs.*' => 'exists:joueurs,id', // Chaque buteur doit exister dans la table joueurs
            'passeurs' => 'nullable|array',
            'passeurs.*' => 'exists:joueurs,id', // Chaque passeur doit exister dans la table joueurs
            'homme_du_match' => 'nullable|exists:joueurs,id', // L'homme du match doit exister dans la table joueurs
        ];
    }
}
