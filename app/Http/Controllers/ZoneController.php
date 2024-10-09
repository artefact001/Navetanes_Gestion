<?php


namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequest;

class ZoneController extends Controller
{
public function inscrireZone(Request $request)
   {
       // Validation des données
       $validator = validator($request->all(), [
           'nom' => ['required', 'string', 'max:255'],
           'prenom' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'photo_profile' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
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
           $password = $request->prenom . Str::random(4); // Example: "prenomXYZ"
           $user = User::create([
               'nom' => $request->nom,
               'prenom' => $request->prenom,
               'email' => $request->email,
               'password' => Hash::make($password), // Encrypt the password
               'photo_profile' => $photo_profile, // Store the photo path if available
           ]);


           // Assign role and promotion if necessary
           $role = Role::firstOrCreate(['name' => 'zone']);
           $user->assignRole($role);

        //    if ($request->has('promotion_id')) {
        //        $user->promotions()->attach($request->promotion_id);
        //    }


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
