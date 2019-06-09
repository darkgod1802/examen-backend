<?php

namespace Examen\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;

class VerificarConexionBD
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
        //Test database connection
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return response()->json([ 'error' => [
                'http_code' => '500',
                'message' => "No se pudo conectar con la base de datos, es posible que la base de datos se encuentre fuera de servicio",
            ]
            ],500);
        }
        return $next($request);
    }
}
