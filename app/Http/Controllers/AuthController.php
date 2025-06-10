<?php

namespace App\Http\Controllers;
use App\Models\CustomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        // Validate and authenticate the user
        // Redirect to intended page or dashboard
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];
         // Debug untuk melihat konfigurasi auth providers
        //dd(Auth::attempt($credentials)); // Debug apakah login berhasil


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role->role_name == 'leader') {
                return redirect()->route('leader.dashboard');
            } elseif ($user->role->role_name == 'user') {
                return redirect()->route('staff.dashboard');
            }
        }


        // If authentication is successful, redirect to the intended page or dashboard
        // If authentication fails, redirect back with an error

        return back()->withErrors(['login' => 'Username or password is incorrect.']);
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout()
    {
        // Log out the user and redirect to login page
        Auth::logout();
        return redirect('/login');
    }
}
