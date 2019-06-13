<?php

namespace Examen\Http\Controllers;

use Examen\BL\UsuarioBL;
use Examen\Helpers\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioControlador extends Controller
{
    public function iniciarSesion(Request $request){
        $validador = Validator::make($request->all(),[
            'correo'        => 'required|email',
            'contraseña'    => 'required',
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
}
