<?php


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;
// use Tymon\JWTAuth\Facades\JWTAuth;

// class AuthController extends Controller
// {
//     /**
//      * Méthode pour authentifier l'utilisateur et générer un token JWT.
//      *
//      * @param  Request  $request
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function login(Request $request)
//     {
//         // Validation des données envoyées par le client
//         $request->validate([
//             'email' => 'required|string|email',
//             'password' => 'required|string|min:6',
//         ]);

//         // Créer un tableau des informations d'identification (email et mot de passe)
//         $credentials = $request->only('email', 'password');

//         // Tentative de connexion avec les identifiants fournis
//         if (!$token = JWTAuth::attempt($credentials)) {
//             // Si les identifiants sont incorrects, retourner une réponse d'erreur
//             return response()->json(['error' => 'Invalid credentials'], 401);
//         }

//         // Si la connexion réussit, retourner une réponse avec le token JWT
//         return $this->respondWithToken($token);
//     }

//     /**
//      * Méthode pour déconnecter l'utilisateur et invalider le token JWT.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function logout()
//     {
//         // Invalidation du token JWT (déconnexion de l'utilisateur)
//         JWTAuth::invalidate(JWTAuth::getToken());

//         // Retourner une réponse de succès
//         return response()->json(['message' => 'Successfully logged out']);
//     }

//     /**
//      * Méthode pour retourner les informations de l'utilisateur connecté.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function me()
//     {
//         // Récupérer l'utilisateur connecté via JWT
//         return response()->json(auth()->user());
//     }

//     /**
//      * Méthode pour rafraîchir le token JWT (générer un nouveau token).
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function refresh()
//     {
//         // Générer un nouveau token et le retourner
//         return $this->respondWithToken(JWTAuth::refresh());
//     }

//     /**
//      * Méthode utilitaire pour formater la réponse avec le token JWT.
//      *
//      * @param  string  $token
//      * @return \Illuminate\Http\JsonResponse
//      */
//     protected function respondWithToken($token)
//     {
//         // Retourner les détails du token avec sa durée de validité
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             'expires_in' => JWTAuth::factory()->getTTL() * 60, // La durée du token en secondes
//             'user' => auth()->user() // Informations de l'utilisateur connecté
//         ]);
//     }

//     /**
//      * Méthode pour enregistrer un nouvel utilisateur (facultatif).
//      * Elle pourrait être gérée dans le UserController, mais elle peut aussi être ici
//      * si vous voulez gérer à la fois l'inscription et l'authentification dans le même contrôleur.
//      *
//      * @param  Request  $request
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function register(Request $request)
//     {
//         // Validation des données envoyées
//         $request->validate([
//             'nom' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:6|confirmed', // Le mot de passe doit être confirmé
//         ]);

//         // Créer le nouvel utilisateur
//         $user = User::create([
//             'nom' => $request->nom,
//             'email' => $request->email,
//             'password' => Hash::make($request->password), // Hachage du mot de passe
//         ]);

//         // Retourner une réponse de succès avec les détails de l'utilisateur créé
//         return response()->json(['message' => 'User registered successfully', 'user' => $user]);
//     }
// }
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,zone,equipe',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }
}
