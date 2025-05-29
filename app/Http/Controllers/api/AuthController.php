<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register Method
    public function register(Request $request)
    {
        //// Validating user's inputs ////
        $attributes =$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|regex:/^[0-9]{11}$/',
            'address' => 'required|string|max:255',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:8|confirmed',
            'invitation_code' => 'nullable|string|exists:users,code'
        ]);

        // Check if the user uploads an image to store it
        if (!$request->has('image')) {
            //return default avatar image
            $attributes['image'] = asset('profile.png');
        }else{
            // name the image and store it
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $attributes['image'] = $request->file('image')->storeAs('/users/profileImages', $imageName , 'public');
        }

        $attributes['password'] = Hash::make($request->password);

        // Generate The code for the user
        $attributes['code'] = 'REQ-'.now()->format('Ymd').'-'.Str::random(5);

        //After validation succeeded Store the user in the database
        $user = User::create($attributes);


        // Creating a token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'تم تسجيل مستخدم جديد بنجاح',
            'user' => new UserRessource($user),
            'token' => $token,
        ], 200);
    }



    //// Login Method ////
    public function Login(Request $request)
    {
        //Validating credentials
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8'
        ]);

        //Retrieving Admin Data
        $user = User::where('email',$request->email)->first();

        //check the credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['يوجد خطأ ببيانات المستخدم حاول مرة أخرى']);
        }

        // Creating a token
        $token = $user->createToken('auth-token')->plainTextToken;

        //Return token with accepted response
        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => new UserRessource($user),
            'token' => $token,
        ],200);

    }
}
