<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;

use App\Http\Requests\MatcheRequest;
use App\Models\matche;
use App\Services\MatcheService;
use Illuminate\Http\JsonResponse;

class MatcheController extends Controller
{
    protected $matcheService;

    public function __construct(MatcheService $matcheService)
    {
        $this->matcheService = $matcheService;
    }

    /**
     * Afficher la liste des matchs.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $matches = $this->matcheService->recupererTousLesMatches();
        return response()->json($matches, 200);

        $matches = $this->matcheService->getHistoricalMatches();

        return response()->json([
            'message' => 'Historique des matchs récupéré avec succès.',
            'data' => $matches,
        ], 200);
    }

    /**
     * Créer un nouveau match.
     *
     * @param MatcheRequest $request
     * @return JsonResponse
     */
    public function store(MatcheRequest $request): JsonResponse
    {
        $matche = $this->matcheService->creerMatche($request->validated());
        return response()->json($matche, 201);
    }


    /**
     * Afficher un match spécifique.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $matche = $this->matcheService->recupererMatcheParId($id);
        return response()->json($matche, 200);
    }

    /**
     * Mettre à jour un match existant.
     *
     * @param MatcheRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MatcheRequest $request, int $id): JsonResponse
    {
        $matche = $this->matcheService->recupererMatcheParId($id);
        $matche = $this->matcheService->mettreAJourMatche($match, $request->validated());
        return response()->json($matche, 200);
    }

    /**
     * Supprimer un matche.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $matche = $this->matcheService->recupererMatchParId($id);
        $this->matcheService->supprimerMatche($matche);
        return response()->json(null, 204);
    }


// gestion des notification pour les matches

public function terminerMatche(Request $request, $id)
{
    $matche = Matche::findOrFail($id);
    $matche->score_local = $request->input('score_local');
    $matche->score_visiteur = $request->input('score_visiteur');
    $matche->status = 'terminé';
    $matche->save();

    // Envoi des notifications via le service de notification
    app(NotificationService::class)->notifierResultatMatche($matche);

    return response()->json([
        'message' => 'Le match a été terminé avec succès et les notifications ont été envoyées.',
    ], 200);
}


public function updateClassement($equipeId, $resultat)
{
    // Récupérer le classement actuel de l'équipe
    $classement = Classement::where('equipe_id', $equipeId)->first();

    // Mise à jour des statistiques
    $classement->matches_joues += 1;

    if ($resultat === 'gagne') {
        $classement->gagne += 1;
        $classement->points += 3; // 3 points pour une victoire
    } elseif ($resultat === 'nul') {
        $classement->nul += 1;
        $classement->points += 1; // 1 point pour un match nul
    } else {
        $classement->perdu += 1;
    }

    // Mettez à jour les buts marqués et encaissés
    // Supposez que vous avez ces valeurs dans les résultats du match
    $butsMarques = $resultat['buts_marques'];
    $butsEncaisses = $resultat['buts_encaisses'];

    $classement->buts_marques += $butsMarques;
    $classement->buts_encaisses += $butsEncaisses;
    $classement->diff_buts = $classement->buts_marques - $classement->buts_encaisses;

    $classement->save();
}

}
