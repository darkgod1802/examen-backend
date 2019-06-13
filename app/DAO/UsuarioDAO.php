<?php


namespace Examen\DAO;


use Examen\Modelos\Usuario;

class UsuarioDAO
{
    public function existeUsuario($correo){
        if(Usuario::where('correo', '=', $correo)->where('deleted_at','=',null)->exists())
            return true;
        return false;
    }
    public function obtenerUsuario($correo){
        $usuario=Usuario::where('correo', '=', $correo)->where('deleted_at','=',null)->first();
        return $usuario;
    }
}
