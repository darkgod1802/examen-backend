<?php


namespace Examen\DAO;


use Examen\Modelos\Rol;

class RolDAO
{
    public function obtenerRol(int $id){
        $rol=Rol::find($id);
        return $rol;
    }
    public function obtenerRolesPrivilegiados(String $ruta){
        $roles=Rol::join('roles_privilegios', 'roles_privilegios.rol_id', '=', 'roles.id')
            ->join('privilegios', 'roles_privilegios.privilegio_id', '=', 'privilegios.id')
            ->where('privilegios.ruta', '=', $ruta)
            ->select('roles.*')
            ->get();
        return $roles;
    }
}
