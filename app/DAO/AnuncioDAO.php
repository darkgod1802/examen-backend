<?php


namespace Examen\DAO;


use Examen\Modelos\Anuncio;

class AnuncioDAO
{
    public function obtenerAnuncios($parametros){
        $anuncio=Anuncio::join('usuarios', 'anuncios.usuario_id', '=', 'usuarios.id')
            ->where('anuncios.deleted_at','=',null)
            ->where('anuncios.titulo','LIKE','%'.$parametros['clave'].'%')
            ->orWhere('anuncios.descripcion','LIKE','%'.$parametros['clave'].'%')
            ->select('anuncios.id','anuncios.titulo','anuncios.descripcion','anuncios.fecha','anuncios.hora',
                        'usuarios.nombres','usuarios.apellidos','usuarios.correo')
            ->orderBy('anuncios.'.$parametros['tipo'], $parametros['orden'])
            ->paginate($parametros['cantidad']);

        return $anuncio;
    }
    public function guardarAnuncio(Anuncio $anuncio){
        $anuncio->save();
        return $anuncio;
    }
    public function obtenerAnuncio($id){
        $anuncio=Anuncio::find($id);
        return $anuncio;
    }
    public function existeAnuncio($id){
        if(Anuncio::where('id','=',$id)->where('deleted_at','=',null)->exists())
            return true;
        return false;
    }
    public function eliminarAnuncio($id){
        $anuncio=Anuncio::find($id);
        $anuncio->deleted_at=date("Y-m-d H:i:s");
        $anuncio->save();
    }

}
