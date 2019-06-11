<?php

namespace Examen\Http\Controllers;

use Examen\BL\AnuncioBL;
use Examen\Helpers\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnuncioControlador extends Controller
{
    public function crear(Request $request){
        $validador = Validator::make($request->all(),[
            'titulo'        => 'required|max:40',
            'descripcion'   => 'required|max:400',
            'fecha'         => 'required|date_format:Y-m-d|after:now',
            'hora'          => 'required|date_format:H:i',
            'usuario_id'    => 'required|integer|exists:usuarios,id',
        ]);
        if($validador->fails()){
            $errores = $validador->errors();
            $e=new Error();
            return $e->errorArgumentosInvalidos('No se pudo crear el anuncio, alguno de los '.
            'argumentos es inválido',$errores);
        }
        $datos=$request->json()->all();
        $abl=new AnuncioBL();
        return $abl->crearAnuncio($datos);
    }
    public function leer(Request $request,$id){
        $abl=new AnuncioBL();
        return $abl->leerAnuncio($id);
    }
    public function listar(Request $request){
        $validador = Validator::make($request->all(),[
            'tipo'          => [ Rule::in('id','fecha')],
            'orden'         => [ Rule::in('asc','desc')],
            'cantidad'      => 'int',
        ]);
        if($validador->fails()){
            $errores = $validador->errors();
            $e=new Error();
            return $e->errorArgumentosInvalidos('No se pudo actualizar el anuncio, alguno de los '.
                'argumentos es inválido',$errores);
        }
        $datos=$request->json()->all();
        $abl=new AnuncioBL();
        return $abl->listarAnuncios($datos);
    }
    public function eliminar(Request $request,$id){
        $abl=new AnuncioBL();
        return $abl->eliminarAnuncio($id);
    }
    public function actualizar(Request $request,$id){
        $validador = Validator::make($request->all(),[
            'titulo'        => 'max:40',
            'descripcion'   => 'max:400',
            'fecha'         => 'date_format:Y-m-d|after:now',
            'hora'          => 'date_format:H:i',
        ]);
        if($validador->fails()){
            $errores = $validador->errors();
            $e=new Error();
            return $e->errorArgumentosInvalidos('No se pudo actualizar el anuncio, alguno de los '.
                'argumentos es inválido',$errores);
        }
        $datos=$request->json()->all();
        $abl=new AnuncioBL();
        return $abl->actualizarAnuncio($datos,$id);
    }
}
