<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\CustomUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->input('date') 
        ? Carbon::parse($request->input('date'))->startOfDay()
        : Carbon::today();



        $actlogs = ActivityLog::with('custom_users')->orderBy('created_at', 'desc')->whereDate('created_at', $date)->get();

        return view('leader.actlog', compact('actlogs', 'date'));
    }

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
        //dd($request->all());
        // Validate and authenticate the user
        // Redirect to intended page or dashboard
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        

        $credentials = ['username' => $request->username, 'password' => $request->password];
         // Debug untuk melihat konfigurasi auth providers
        //dd(Auth::attempt($credentials)); // Debug apakah login berhasil

        //dd(['username_in_request' => $request->username, 'credentials_before_auth' => $credentials]);
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            //Auth::login($user);
            //dd(Auth::user());
            // Log aktivitas login
            \App\Models\ActivityLog::record(
                $user->id,
                $user->role->role_name ?? 'guest',
                'login',
                null,
                'User logged in'
            );

            // Redirect sesuai role
            if ($user->role->role_name == 'Leader') {
                return redirect()->route('leader.dashboard');
            } elseif ($user->role->role_name == 'Staff') {
                return redirect()->route('leader.dashboard');
            }
        }
        //dd($request->all());
        //dd($credentials); // Debug untuk melihat data user yang berhasil login
        // If authentication is successful, redirect to the intended page or dashboard
        // If authentication fails, redirect back with an error
        //dd(Auth::user());
        return back()->with('error', 'Username or password is incorrect.');
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout()
    {
        $user = Auth::user();
        \App\Models\ActivityLog::record(
            $user->id,
            $user->role->role_name ?? 'guest',
            'logout',
            null,
            'User logged out'
        );

        Auth::logout();
        return redirect('/login');
    }
}
