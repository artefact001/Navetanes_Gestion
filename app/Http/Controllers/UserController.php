<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Notifications\UserCreatedNotification;
use App\Http\Requests\ValidationRequest;

class UserController extends Controller
{
    // Store a new user
    public function store(Request $request)
    {
        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        // Assign role to user
        $role = Role::findOrCreate($request->role);
        $user->assignRole($role);

        // Send a notification email with login credentials
        // $user->notify(new UserCreatedNotification($user->email, $request->password));

        return response()->json(['message' => 'User created successfully', 'user' => $user]);


    }
//
    // Fetch all users
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
}
