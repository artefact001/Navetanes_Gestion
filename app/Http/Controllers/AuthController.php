<?php


namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role; // Utilise le modèle de Spatie
use App\Notifications\ZoneInscriptionNotification;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidationRequest;

class AuthController extends Controller
{
public function inscrireZone(Request $request)
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
               'role'  => 'admin',
               'photo_profile' => $photo_profile, // Store the photo path if available
           ]);

                if ($user) {
                    Zone::create([
                    'nom' => $request->nom_equipe,
                    'localite' => $request->localite,
                    'user_id' => $request->$user->id,
                    ]);
                    }




           // Send email notification
           $user->notify(new ZoneInscriptionNotification($user, $password));


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
}


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
               'role'  => 'equipe',
               'photo_profile' => $photo_profile, // Store the photo path if available
           ]);

            if ($user) {
                    Equipe::create([
                    'nom' => $request->nom_equipe,
                    'localite' => $request->localite,
                    'logo' => $request->logo,
                    'date_creer' => $request->date_creer,
                    'zone_id' => $request->zone_id,
                    'user_id' => $request->$user->id,
                    ]);
                    }




           // Send email notification
           $user->notify(new ZoneInscriptionNotification($user, $password));


           return response()->json([
               'success' => true,
               'message' => 'Equipe inscrit avec succès et notification envoyée par email',
               'user' => $user
           ], 201);
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'Une erreur est survenue : ' . $e->getMessage()
           ], 500);
       }
   }

 }
{
             public function inscrireAdmin(Request $request)
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
               'role'  => 'admin',
               'photo_profile' => $photo_profile, // Store the photo path if available
           ]);


                     if ($user) {
                    Admin::create([
                    'nom' => $request->admin,
                    'email' => $request->email,

                    ]);
                    }


           // Assign role and promotion if necessary
        //    $role = Role::firstOrCreate(['name' => 'admin']);
        //    $user->assignRole($role);



           // Send email notification
           $user->notify(new ZoneInscriptionNotification($user, $password));


           return response()->json([
               'success' => true,
               'message' => 'Administrateur inscrit avec succès et notification envoyée par email',
               'user' => $user
           ], 201);
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'Une erreur est survenue : ' . $e->getMessage()
           ], 500);
       }
   }

 }
