<?php


namespace Examen\Helpers;


class Error
{
    protected $statusCode = 200;
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }
    protected function responderConError($message) {
        return response()->json([ 'error' => [
            'http_code' => $this->statusCode,
            'mensaje' => $message,
        ]
        ],$this->statusCode);
    }
    protected function responderConErrorDetallado($message,$detalle) {
        return response()->json([ 'error' => [
            'http_code' => $this->statusCode,
            'mensaje' => $message,
            'detalle'=> $detalle,
        ]
        ],$this->statusCode);
    }

    public function errorNoEncontrado($message = 'Recurso no encontrado') {
        return $this->setStatusCode(404) ->responderConError($message);
    }
    public function errorNoAutorizado($message = 'No autorizado') {
        return $this->setStatusCode(401) ->responderConError($message);
    }
    public function errorArgumentosInvalidos($message = 'Argumentos invalidos',$detalle = null){
        $this->setStatusCode(400);
        if(!$detalle)
            return $this->responderConError($message);
        else
            return $this->responderConErrorDetallado($message,$detalle);
    }
}
