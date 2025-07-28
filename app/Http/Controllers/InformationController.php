<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Division;
use App\Models\Informacion;

class InformationController extends Controller
{
    public function listContent(){
        $data = Informacion::obtenerContenido();
        return view('admin.contenido', compact('data'));
    }

    public function getContent($id){
        $division = Division::get();
        $contenido = json_encode(Informacion::obtenerContenidoxid($id));
        return view('admin.editor', compact('division', 'contenido'));
    }

    public function updateContenido(Request $request){
        try {
            $contenido = Informacion::where('id', '=', $request->id)->first();
            if (isset($contenido)) {
                $contenido->update([
                    'titulo' => $request->titulo,
                    'description' =>  $request->contenido,
                    'user_id' => 1, ///logica para traer el usuario logueado
                    'division_id' =>  $request->division_id,
                ]);

                return true;
            }
        } catch (\Exception $e) {
            dd($e);
        }

    }
}
