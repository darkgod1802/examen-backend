<?php

namespace Examen\Modelos;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';
    protected $fillable = ['titulo','descripcion','fecha','hora','usuario_id'];
    protected $hidden =['updated_at','deleted_at'];
}
