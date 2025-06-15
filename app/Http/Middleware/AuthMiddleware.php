<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        //dd('Middleware AUTH berjalan! User:', Auth::user());
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect kalau belum login
        }

        $user = Auth::user();
        //dd($user->id, $request->path());
        // Log aktivitas akses halaman
        \App\Models\ActivityLog::record(
            $user->id,
            $user->role->role_name ?? 'guest',
            'access',
            null,
            'Entering ' . $request->path() . ' page'
        );
        // Log informasi user yang sedang aktif
        //\Illuminate\Support\Facades\Log::info('AUTH Middleware aktif, user: ' . (Auth::user()->id ?? 'Guest'));

        return $next($request);
    }

}
