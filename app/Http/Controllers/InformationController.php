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
}
