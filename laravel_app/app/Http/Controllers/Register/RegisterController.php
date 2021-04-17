<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
    	// set rules for validation
        $rules = [
            'name' => ['required', 'min:2', 'max:40'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
        
        // perform validation
        $request->validate($rules);

        // dd($request->all());

        // check input feild and make password hash
        // $data = $request->all();
        // $data['password'] = ;
        // $data['verified'] = ;
        // $data['verification_token'] = ;
        // $data['admin'] = User::REGULAR_USER;

        // create users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'verified' => User::UNVERIFIED_USER, 
            'verification_token' => User::generateVerificationCode(), 
            'admin' => User::REGULAR_USER
        ]);

    }
}
