<?php

namespace App\Http\Controllers\Login;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	// SPA area for the code
    	// $request->validate([
    	// 	'email' => ['required'],
    	// 	'password' => ['required']
    	// ]);

    	// if (Auth::attempt($request->only('email', 'password'))) {
    	// 	return response()->json(Auth::user(), 200);
    	// }

    	// throw ValidationException::withMessages([
    	// 	'email' => ['the Provided credentials are incorrect']
    	// ]);
    	

    	// api area of the code
    	$request->validate([
    		'email' => ['required'],
    		'password' => ['required'],
    	    'device_name' => 'required',
	    ]);

	    $user = User::where('email', $request->email)->first();

	    if (! $user || ! Hash::check($request->password, $user->password)) {
	        throw ValidationException::withMessages([
	            'email' => ['The provided credentials are incorrect.'],
	        ]);
	    }

	    return $user->createToken($request->device_name)->plainTextToken;
	    }

	    // logout function
	    public function logout(Request $request)
	    {
	    	$request->user()->tokens()->delete();

            return response()->json('logout', 201);
	    }
}
