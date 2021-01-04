<?php

namespace App\Http\Middleware;

use App\UsuarioSistema;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $token = explode(' ', $request->header('Authorization'))[1];
        } catch (Exception $e) {
            $token = $request->header('Authorization');
        }

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token nao fornecido.',
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'TOKEN expirado.',
            ], 401);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao decodificar TOKEN. ' . $e->getMessage(),
            ], 401);
        }
        $user = UsuarioSistema::find($credentials->sub);
        $request->auth = $user;

        return $next($request);
    }
}
