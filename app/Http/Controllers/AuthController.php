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

        if ($response['success']) {
            $data = $response['data']; // Get user data
            session(['token' => $response['access_token']]); // Store access token in session
            session(['user' => $data]); // Store access token in session
            return redirect('/');
        } else {
            return back()->with('error', 'Sorry your credentials are invalid. Please try again!');
        }
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

    /**
     * Sign user out and delete session data
     *
     * @param Request $request
     * @return void
     */
    public function signOut(Request $request)
    {
        $request->session()->forget('token');
        $request->session()->forget('user');
        return redirect('login')->with('success', "You've signed out successfully");
    }
}
