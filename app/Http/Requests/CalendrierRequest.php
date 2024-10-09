<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendrierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'match_id' => 'required|exists:matches,id', // Le match doit exister
            'date_heure' => 'required|date',            // Date et heure valides
            'lieu' => 'required|string|max:255',        // Lieu requis
        ];
    }
}
