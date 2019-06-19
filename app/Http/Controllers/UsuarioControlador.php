<?php

namespace Examen\Http\Controllers;

use Examen\BL\UsuarioBL;
use Examen\Helpers\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\JWTAuth;

class UsuarioControlador extends Controller
{
    public function iniciarSesion(Request $request){
        $validador = Validator::make($request->all(),[
            'correo'        => 'required|email',
            'contra'        => 'required',
        ]);
        if($validador->fails()){
            $errores = $validador->errors();
            $e=new Error();
            return $e->errorArgumentosInvalidos('No se pudo iniciar sesión, alguno de los '.
                'argumentos es inválido',$errores);
        }
        $datos = $request->json()->all();
        $ubl=new UsuarioBL();
        return $ubl->ingresar($datos);
    }
    public function renovarToken(Request $request){
        $error=new Error();
        try {
            $token = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->refresh();
            return response()->json(compact('token'));
        }
        catch (TokenBlacklistedException $e){
            return $error->errorNoAutorizado("Token expirado");
        } catch (JWTException $e) {
            return $error->errorNoAutorizado("Token expirado");
        }
    }
}
