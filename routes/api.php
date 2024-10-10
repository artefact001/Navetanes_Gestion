<?php
use App\Http\Requests\ValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\EquipeController;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\{
    UserController, CompetitionController, MatcheController, JoueurController,
    TirageController, ReclamationController, NotificationController, ResultatController, ClassementController,
    PointController, CalendrierController, DashboardViewController, DashboardController, StatistiqueController,
    ArticleController, CommentaireController
};


// Route pour inscrire une zone
Route::post('/inscrire-zones', [ZoneController::class, 'inscrireZone']);
Route::post('/inscrire-zones', [AuthController::class, 'inscrireZone']);

// Route pour inscrire une equipe
Route::post('/inscrire-equipe', [EquipeController::class, 'inscrireEquipe']);
Route::post('/inscrire-equipe', [AuthController::class, 'inscrireEquipe']);



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:api'])->group(function () {
    Route::resource('zones', ZoneController::class);
    Route::resource('equipes', EquipeController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

// User management routes as resource
Route::middleware('auth:api')->group(function () {
    Route::resource('users', UserController::class);
});

// Competition management with role-based access control
Route::middleware(['auth:api', 'role:Zone'])->group(function () {
    Route::apiResource('competitions', CompetitionController::class);
});

// Article and Comment routes
Route::middleware('auth:api')->group(function () {
    Route::apiResource('articles', ArticleController::class);
    Route::post('articles/{articleId}/commentaires', [CommentaireController::class, 'store']);
    Route::delete('commentaires/{id}', [CommentaireController::class, 'destroy']);
});

// Resourceful API routes
Route::apiResource('joueurs', JoueurController::class);
Route::apiResource('equipes', EquipeController::class);
Route::apiResource('matches', MatcheController::class);
Route::apiResource('tirages', TirageController::class);

// Special route for launching a draw
Route::post('tirages/lancer', [TirageController::class, 'lancerTirage']);

// Reclamation routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('reclamations', [ReclamationController::class, 'store']);
    Route::patch('reclamations/{id}/status', [ReclamationController::class, 'updateStatus']);
});

// Notification routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('notifications/read-all', [NotificationController::class, 'markAllAsRead']);
});

// Result management routes
Route::prefix('resultats')->group(function () {
    Route::post('/', [ResultatController::class, 'store']);
    Route::get('/matche/{matcheId}', [ResultatController::class, 'show']);
    Route::post('/matche/{matcheId}/winner', [ResultatController::class, 'determineWinner']);
});

// Ranking and Points
Route::get('rankings', [PointController::class, 'rankings']);
Route::get('teams/{equipeId}/points', [PointController::class, 'teamPoints']);
Route::get('classement', [ClassementController::class, 'getGlobalRankings']);
Route::get('classement/equipe/{equipeId}', [ClassementController::class, 'getTeamRank']);

// Calendrier management routes
Route::apiResource('calendriers', CalendrierController::class)->except(['show']);
Route::get('calendriers/match/{matchId}', [CalendrierController::class, 'getByMatch']);

// Dashboard view and statistics routes
Route::get('dashboard', [DashboardViewController::class, 'index']);
Route::get('dashboard/stats', [DashboardController::class, 'getStats']);

// Statistique management routes
Route::prefix('statistiques')->group(function () {
    Route::apiResource('/', StatistiqueController::class)->except('show');
    Route::get('/joueur/{joueurId}', [StatistiqueController::class, 'showByJoueur']);
});


