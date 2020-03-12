<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\APIService;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $response = APIService::login($credentials); // Make login request to API with user credentials

        session(['user' => $response]); // Store the user information in session

    }
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function submitRegister(Request $request)
    {
        $credentials = $request->only(['email', 'password','firstname','lastname','password_confirmation','phone_number','profile_url']);

        $response = APIService::register($credentials); // Make login request to API with user credentials
    }


}
