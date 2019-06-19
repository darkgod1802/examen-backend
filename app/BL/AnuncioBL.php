<?php


namespace Examen\BL;

use Examen\DAO\AnuncioDAO;
use Examen\Helpers\Error;
use Examen\Modelos\Anuncio;
use Illuminate\Support\Facades\Log;
class AnuncioBL
{
    public function listarAnuncios($datos){
        $parametros=[
            'clave'     =>'',
            'tipo'      =>'id',
            'orden'     =>'desc',
            'cantidad'  => 10
        ];
        $campos = ['clave', 'orden', 'tipo'];
        foreach($campos as $campo){
            Log::info("aqui");
            if(!empty($datos[$campo])){
                $parametros[$campo]=$datos[$campo];
            }
        }
        $adao=new AnuncioDAO();
        $anuncios=$adao->obtenerAnuncios($parametros);
        return response()->json($anuncios);
    }
    public function crearAnuncio($datos,$usuario_id){
        $anuncio=new Anuncio();
        $anuncio->titulo=$datos['titulo'];
        $anuncio->descripcion=$datos['descripcion'];
        $anuncio->fecha=$datos['fecha'];
        $anuncio->hora=$datos['hora'];
        $anuncio->usuario_id=$usuario_id;
        $adao=new AnuncioDAO();
        $anuncio=$adao->guardarAnuncio($anuncio);
        return response()->json($anuncio,201);
    }
    public function leerAnuncio($id){
        $adao=new AnuncioDAO();
        if(!$adao->existeAnuncio($id)){
            $e=new Error();
            return $e->errorNoEncontrado("El anuncio con id=".$id. " no existe");
        }
        $anuncio=$adao->obtenerAnuncio($id);
        return response()->json($anuncio);
    }
    public function eliminarAnuncio($id){
        $adao=new AnuncioDAO();
        if(!$adao->existeAnuncio($id)){
            $e=new Error();
            return $e->errorNoEncontrado("El anuncio que trata de eliminar no existe");
        }
        $adao->eliminarAnuncio($id);
        Log::info("exito");
        return response()->json(null, 204);
    }
    public function actualizarAnuncio($datos,$id){
        $adao=new AnuncioDAO();
        if(!$adao->existeAnuncio($id)){
            $e=new Error();
            return $e->errorNoEncontrado("El anuncio que trata de eliminar no existe");
        }
        $anuncio=$adao->obtenerAnuncio($id);
        $fields = ['titulo', 'descripcion', 'fecha', 'hora'];
        foreach($fields as $field){
            if(!empty($datos[$field])){
                $anuncio->$field=$datos[$field];
            }
        }
        $adao=new AnuncioDAO();
        $anuncio=$adao->guardarAnuncio($anuncio);
        return response()->json($anuncio,200);
    }
}
