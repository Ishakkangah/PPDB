<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminCheck
{
    public function handle(Request $request, Closure $next)
    {
        if($request->path() === 'app/login'){
            return $next($request);
        }
        // Jika belum login dan akses route web laravel 
        if(!Auth::check()){
            return response()->json([
                'msg' => 'Anda tidak punya akses pada route ini',
                'url' => $request->path()
            ], 403);
        }
        // Jika sudah login namun role == 0
        $user = Auth::user();
        if($user->role->isAdmin === 0){
            return response()->json([
                'msg' => 'Anda tidak punya akses pada route ini',
                'url' => $request->path()
            ], 403);
        }
        return $next($request);
    }
}
