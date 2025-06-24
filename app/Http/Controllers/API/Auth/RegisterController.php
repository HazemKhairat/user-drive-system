<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->file() != null){
            $imageData = $request->file('image');
            $drive_name = rand(0, 200) . rand(0, 200) . $imageData->getClientOriginalName();
            $location = public_path('users');
            $imageData->move($location, $drive_name);
        }
        else{
            $drive_name = 'fake.jpg';
        }
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $drive_name
        ]);


        event(new Registered($user));

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['message' => 'Registered Successuflly','user' => $user, 'token' => $token], 200);
    }
}
