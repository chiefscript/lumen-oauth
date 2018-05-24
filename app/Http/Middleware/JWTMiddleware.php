<?php

namespace App\Http\Middleware;

use App\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JWTMiddleware
{
    public function handle($request, \Closure $next, $guard = null)
    {
        $token = $request->get('token');

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
        $user = User::find($credentials->sub);

        $request->auth = $user;
        return $next($request);
    }
}