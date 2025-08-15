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
        return Informacion::select('informacion.id', 'description','titulo', 'informacion.division_id', 'nombre', 'apellido')
                          ->where('informacion.id', '=', $id)
                          ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                          ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                          ->get();
    }

    public static function manuales($division){
        return  Informacion::select('id', 'division_id', 'titulo')
                           ->where('division_id', '=', $division)
                           ->get();
    }

    // manual por division en especifico
    public static function manual($division, $id_manual){
         // Debe recibir parametros de id division y  el id del manual esto via url
        return  Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', $division)
                            ->where('informacion.id', '=', $id_manual)
                            ->first();
    }

    public static function getSoporte(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 1)
                            ->get();
    }

    public static function getRedes(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 2)
                            ->get();
    }

    public static function getDesarrollo(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 3)
                            ->get();
    }

}
