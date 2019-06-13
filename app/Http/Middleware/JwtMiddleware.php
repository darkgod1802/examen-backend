<?php

namespace Examen\Http\Middleware;

use Closure;
use Examen\BL\UsuarioBL;
use Exception;
use Illuminate\Support\Facades\Log;
use JWTAuth;

class JwtMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token=JWTAuth::parseToken();
            $token->getPayload()->get('sub');
            $token->getPayload()->get('name');
            $token->getPayload()->get('rol');
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->errorNoAutorizado("Token invalido");
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                try {
                    $refreshed = JWTAuth::parseToken()->refresh();
                    Log::info($refreshed);
                    $request->headers->set('Authorization', 'Bearer ' . $refreshed);
                    Log::info('Token refrescado');
                    $this->handle($request,$next);
                }
                catch (JWTException $e) {
                    return $this->errorNoAutorizado("Token expirado");
                }
            }else{
                return $this->errorNoAutorizado("Token de autorización no encontrado");
            }
        }
        $ruta=$request->route()->getActionName();
        $ruta = substr($ruta, 24);
        $autorizacion=new UsuarioBL();
        $acceso=$autorizacion->verificarAutorizacion($ruta, $token);
        if($acceso){
            return $next($request);
        }else{
            return $this->errorNoAutorizado("Usuario no autorizado para acceder a esta ruta");
        }

    }
    public function errorNoAutorizado($message = 'No se encuentra autorizado'){
        return response()->json([ 'error' => [
            'http_code' => '401',
            'message' => $message,
        ]
        ],401);
    }
}
