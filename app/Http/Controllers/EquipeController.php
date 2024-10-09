<?php
namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequest;


class EquipeController extends Controller

{

public function inscrireEquipe(Request $request)
{
    // Validation des données
    $validator = validator($request->all(), [
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'logo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
    ]);

    // En cas d'échec de validation
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        // Gestion de l'upload du logo
        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('profiles', 'public');
        }

        // Génération d'un mot de passe plus sécurisé
        $password = Str::random(8); // Mot de passe sécurisé de 8 caractères aléatoires

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($password), // Hachage du mot de passe
            'logo' => $logo, // Stockage du chemin du logo si disponible
        ]);

        // Attribution du rôle 'Equipe' à l'utilisateur
        $role = Role::firstOrCreate(['name' => 'Equipe']);
        $user->assignRole($role);

        // Envoi de la notification par email
        $user->notify(new EquipeInscriptionNotification($user, $password));

        // Réponse en cas de succès
        return response()->json([
            'success' => true,
            'message' => 'Equipe inscrite avec succès et notification envoyée par email',
            'user' => $user
        ], 201);
    } catch (\Exception $e) {
        // Gestion des erreurs
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue : ' . $e->getMessage(),
        ], 500);
    }
}


}
