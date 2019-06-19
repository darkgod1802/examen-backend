<?php


namespace Examen\BL;


use Examen\DAO\RolDAO;
use Examen\DAO\UsuarioDAO;
use Examen\Helpers\Error;
use Illuminate\Support\Facades\Log;
use JWTAuth;

class UsuarioBL
{
    public function ingresar($datos){
        $e=new Error();
        $udao=new UsuarioDAO();
        $rdao=new RolDAO();
        if(!$udao->existeUsuario($datos['correo'])){
            return $e->errorNoEncontrado("El usuario con correo ".$datos['correo']. " no existe");
        }
        $usuario=$udao->obtenerUsuario($datos['correo']);
        $clave=$usuario->contraseña;
        $clave_in=hash("sha256", $datos['contra']);
        if($clave_in!=$clave){
            return $e->errorArgumentosInvalidos("Contraseña incorrecta");
        }
        $rol=$rdao->obtenerRol($usuario->rol_id);
        $extras = ['rol' => $rol->nombre,'nombre'=> $usuario->nombres];
        $token = JWTAuth::fromUser($usuario, $extras);
        return response()->json(compact('token'));
    }
    public function verificarAutorizacion(String $ruta, $token){
        Log::info($ruta);
        $token_rol=$token->getPayload()->get('rol');
        $rolpriv=new RolDAO();
        $roles=$rolpriv->obtenerRolesPrivilegiados($ruta);
        foreach ($roles as $rol){
            Log::info($rol->nombre);
            if($rol->nombre==$token_rol){
                return true;
            }
        }
        return false;
    }
}
