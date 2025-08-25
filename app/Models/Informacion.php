<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Division;

class Informacion extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'titulo',
        'description',
        'user_id',
        'division_id',
        'url'
    ];

    protected $table = 'informacion';

    public Static function obtenerContenido(){
        return Informacion::select('informacion.id', 'nombre', 'division', 'titulo', 'url')
                          ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                          ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                          ->get();
    }

    public Static function obtenerContenidoxid($id){
        return Informacion::select('informacion.id', 'description','titulo', 'informacion.division_id', 'nombre', 'apellido', 'url')
                          ->where('informacion.id', '=', $id)
                          ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                          ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                          ->get();
    }

    public static function manuales($division){
        $division_id =  Division::where('division', '=', $division)->pluck('id')->first();
        return Informacion::select('informacion.id', 'division_id', 'titulo', 'url', 'division')
                           ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                           ->where('division_id', '=', $division_id)
                           ->get();
                        
    }

    // manual por division en especifico
    public static function manual($division, $titulo){
         // Debe recibir parametros de id division y  el id del manual esto via url
        return  Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division', 'url')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('division.division', '=', $division)
                            ->where('informacion.titulo', '=', $titulo)
                            ->first();
    }

    public static function getSoporte(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division', 'url')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 1)
                            ->get();
    }

    public static function getRedes(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division', 'url')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 2)
                            ->get();
    }

    public static function getDesarrollo(){
        return Informacion::select('informacion.id', 'titulo', 'description', 'informacion.division_id', 'nombre', 'apellido', 'division', 'url')
                            ->leftJoin('division', 'informacion.division_id', '=', 'division.id')
                            ->leftJoin('usuarios', 'informacion.user_id', '=', 'usuarios.id')
                            ->where('informacion.division_id', '=', 3)
                            ->get();
    }
    
    public static function getContenidosCountAttribute(){
        return Informacion::count();
    }
}
