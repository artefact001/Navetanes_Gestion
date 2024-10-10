<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Equipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ZoneInscriptionNotification;
use Spatie\Permission\Models\Role; // Utilise le modèle de Spatie pour la gestion des rôles

class AuthController extends Controller
{
    /**
     * Fonction pour inscrire une zone.
     * Cette méthode valide les données de la requête, crée un utilisateur et une zone,
     * puis envoie une notification par email à l'utilisateur avec son mot de passe.
     */
    public function inscrireZone(Request $request)
    {
        // Valider les données de la requête
        $validator = validator($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Si la validation échoue, retourner une réponse avec les erreurs
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Créer un utilisateur avec le rôle d'admin
            $user = $this->createUser($request, 'admin');

            // Si l'utilisateur est créé avec succès, créer la zone correspondante
            if ($user) {
                Zone::create([
                    'nom' => $request->nom_equipe,
                    'localite' => $request->localite,
                    'user_id' => $user->id,
                ]);

                // Envoyer la notification par email
                $user->notify(new ZoneInscriptionNotification($user, $user->password));

                // Retourner une réponse JSON de succès
                return response()->json([
                    'success' => true,
                    'message' => 'Zone inscrit avec succès et notification envoyée par email',
                    'user' => $user,
                ], 201);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une réponse JSON avec le message d'erreur
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fonction pour inscrire une équipe.
     * Similaire à l'inscription d'une zone, mais avec le rôle d'équipe.
     */
    public function inscrireEquipe(Request $request)
    {
        // Valider les données de la requête
        $validator = validator($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Si la validation échoue, retourner une réponse avec les erreurs
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Créer un utilisateur avec le rôle d'équipe
            $user = $this->createUser($request, 'equipe');

            // Si l'utilisateur est créé, créer l'équipe correspondante
            if ($user) {
                Equipe::create([
                    'nom' => $request->nom_equipe,
                    'localite' => $request->localite,
                    'logo' => $request->logo,
                    'date_creer' => $request->date_creer,
                    'zone_id' => $request->zone_id,
                    'user_id' => $user->id,
                ]);

                // Envoyer la notification par email
                $user->notify(new ZoneInscriptionNotification($user, $user->password));

                // Retourner une réponse JSON de succès
                return response()->json([
                    'success' => true,
                    'message' => 'Équipe inscrite avec succès et notification envoyée par email',
                    'user' => $user,
                ], 201);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une réponse JSON avec le message d'erreur
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fonction pour inscrire un administrateur.
     * Semblable aux autres méthodes, mais ici, nous attribuons un rôle d'admin.
     */
    public function inscrireAdmin(Request $request)
    {
        // Valider les données de la requête
        $validator = validator($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Si la validation échoue, retourner une réponse avec les erreurs
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Créer un utilisateur avec le rôle d'admin
            $user = $this->createUser($request, 'admin');

            // Si l'utilisateur est créé, ajouter les détails supplémentaires pour l'admin
            if ($user) {
                // Ici vous pouvez ajouter des informations supplémentaires pour l'admin
                // Par exemple, si vous avez une table Admin, vous pouvez la remplir

                // Envoyer la notification par email
                $user->notify(new ZoneInscriptionNotification($user, $user->password));

                // Retourner une réponse JSON de succès
                return response()->json([
                    'success' => true,
                    'message' => 'Administrateur inscrit avec succès et notification envoyée par email',
                    'user' => $user,
                ], 201);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une réponse JSON avec le message d'erreur
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fonction utilitaire pour créer un utilisateur.
     * Cette fonction est réutilisée dans les différentes méthodes d'inscription.
     *
     * @param Request $request
     * @param string $role
     * @return User
     */
    private function createUser($request, $role)
    {
        // Générer un mot de passe aléatoire basé sur le nom de l'utilisateur
        $password = $request->nom . Str::random(4); // Exemple : "prenomXYZ"

        // Gérer le téléchargement de la photo de profil, si elle existe
        $photo_profile = $request->hasFile('photo_profile') 
            ? $request->file('photo_profile')->store('profiles', 'public') 
            : null;

        // Créer l'utilisateur avec les informations fournies
        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($password), // Encrypter le mot de passe
            'role' => $role, // Rôle fourni (admin ou équipe)
            'photo_profile' => $photo_profile, // Chemin de la photo de profil, si disponible
        ]);

        // Assigner le rôle à l'utilisateur avec Spatie
        $roleInstance = Role::firstOrCreate(['name' => $role]);
        $user->assignRole($roleInstance);

        // Ajouter le mot de passe en clair pour l'envoi par email (non sauvegardé en base)
        $user->password = $password;

        return $user;
    }
}
