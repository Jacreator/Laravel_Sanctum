<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$request->validate([
    		'email' => ['required'],
    		'password' => ['required']
    	]);

    	if (Auth::attempt($request->only('email', 'password'))) {
    		return response()->json(Auth::user(), 200);
    	}

    	throw ValidationException::withMessages([
    		'email' => ['the Provided credentials are incorrect']
    	]);
    	
    }

    // logout function
    public function logout()
    {
    	Auth::logout();
    }
}
