<?php
namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role; // Utilise le modèle de Spatie
use App\Notifications\ZoneInscriptionNotification;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidationRequest;

class EquipeController extends Controller

{


public function inscrireEquipe(Request $request)
   {
       // Validation des données
       $validator = validator($request->all(), [
           'nom' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //    'photo_profile' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
       ]);


       if ($validator->fails()) {
           return response()->json([
               'success' => false,
               'errors' => $validator->errors(),
           ], 422);
       }


       try {
           // Handle profile picture upload
           $photo_profile = null;
           if ($request->hasFile('photo_profile')) {
               $photo_profile = $request->file('photo_profile')->store('profiles', 'public');
           }


           // Create the user with the password
           $password = $request->nom . Str::random(4); // Example: "prenomXYZ"
           $user = User::create([
               'nom' => $request->nom,
               'email' => $request->email,
               'password' => Hash::make($password), // Encrypt the password
               'role'  =>$request->role,
               'photo_profile' => $photo_profile, // Store the photo path if available
           ]);


           // Assign role and promotion if necessary
        //    $role = Role::firstOrCreate(['name' => 'admin']);
        //    $user->assignRole($role);



           // Send email notification
        //    $user->notify(new ZoneInscriptionNotification($user, $password));


           return response()->json([
               'success' => true,
               'message' => 'Zone inscrit avec succès et notification envoyée par email',
               'user' => $user
           ], 201);
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'Une erreur est survenue : ' . $e->getMessage()
           ], 500);
       }
   }


// public function inscrireEquipe(Request $request)
// {
//     // Validation des données
//     $validator = validator($request->all(), [
//         'nom' => ['required', 'string', 'max:255'],
//         'prenom' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//         'logo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
//     ]);

//     // En cas d'échec de validation
//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'errors' => $validator->errors(),
//         ], 422);
//     }

//     try {
//         // Gestion de l'upload du logo
//         $logo = null;
//         if ($request->hasFile('logo')) {
//             $logo = $request->file('logo')->store('profiles', 'public');
//         }

//         // Génération d'un mot de passe plus sécurisé
//         $password = Str::random(8); // Mot de passe sécurisé de 8 caractères aléatoires

//         // Création de l'utilisateur
//         $user = User::create([
//             'nom' => $request->nom,
//             'prenom' => $request->prenom,
//             'email' => $request->email,
//             'password' => Hash::make($password), // Hachage du mot de passe
//             'logo' => $logo, // Stockage du chemin du logo si disponible
//         ]);

//         // Attribution du rôle 'Equipe' à l'utilisateur
//         $role = Role::firstOrCreate(['name' => 'Equipe']);
//         $user->assignRole($role);

//         // Envoi de la notification par email
//         $user->notify(new EquipeInscriptionNotification($user, $password));

//         // Réponse en cas de succès
//         return response()->json([
//             'success' => true,
//             'message' => 'Equipe inscrite avec succès et notification envoyée par email',
//             'user' => $user
//         ], 201);
//     } catch (\Exception $e) {
//         // Gestion des erreurs
//         return response()->json([
//             'success' => false,
//             'message' => 'Une erreur est survenue : ' . $e->getMessage(),
//         ], 500);
//     }
// }


}
