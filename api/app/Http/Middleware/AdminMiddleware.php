<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            //code...
            // if (Auth::check()) {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $userModel = User::where('remember_token', $token)->first();
            if ($token) {
                if ($userModel) {
                    if($userModel->role==='Admin'){
                        return $next($request);
                    }else{

                        return response()->json(['message' => 'kamu bukan admin'], 401);
                    }
                }else{
                    return response()->json(['message' => 'Invalid Token'], 401);
                }
            }
        // }

            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Error'+$th], 505);
        }
    }
}
