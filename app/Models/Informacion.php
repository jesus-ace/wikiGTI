<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Informacion extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'titulo',
        'description',
        'user_id',
        'division_id',

    ];

    protected $table = 'informacion';

    public Static function obtenerContenido(){
        return Informacion::select('informacion.id', 'nombre', 'division', 'titulo')
                          ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                          ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                          ->get();
    }

    public Static function obtenerContenidoxid($id){
        return Informacion::select('informacion.id', 'description', 'informacion.division_id', 'titulo')
                          ->where('informacion.id', '=', $id)
                          ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                          ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                          ->get();
    }

    public static function manuales(){
        return  Informacion::select('id', 'titulo')->get();
    }

    // manual por division en especifico
    public static function manual(){
         // Debe resibir parametros de id division y  el id del manual esto via url
        return  Informacion::where('id', '=', 2)->first();
    }
}
