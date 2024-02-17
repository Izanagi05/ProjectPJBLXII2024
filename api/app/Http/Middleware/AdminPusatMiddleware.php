<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPusatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //code...
        // if (Auth::check())
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $userModel = User::where('remember_token', $token)->first();
            if ($token) {
                if ($userModel && $userModel->role === 'Admin') {
                    if ($userModel->AdminData->AdminRole->name === 'Admin Pusat') {
                        return $next($request);
                    } else {
                        return response()->json(['message' => 'kamu bukan admin'], 401);
                    }
                } else {
                    return response()->json(['message' => 'Invalid Token'], 401);
                }
            }
            // }

            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Error' + $th], 505);
        };
    }
}
