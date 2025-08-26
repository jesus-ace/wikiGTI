<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Division;
use App\Models\Informacion;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'id' => 'required|integer|exists:informacion,id',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'division_id' => 'required|integer|exists:division,id',
        ]);

        try {
            $contenido = Informacion::find($validated['id']);

            if (!$contenido) {
                return response()->json([
                    'success' => false,
                    'message' => 'Content not found'
                ], 404);
            }
            $name_division = Division::where('id', '=', $validated['division_id'])->pluck('division');
            $updated = $contenido->update([
                'titulo' => $validated['titulo'],
                'description' => $validated['contenido'],
                'user_id' => Auth::id(), // usuario autentificado
                'division_id' => $validated['division_id'],
                'url' => str_replace(' ', '_',$name_division[0])."/".str_replace(' ', '_', $validated['titulo']),
            ]);

            return response()->json([
                'success' => $updated,
                'message' => $updated ? 'Content updated successfully' : 'Failed to update content',
                'data' => $contenido
            ]);


        } catch (\Exception $e) {
            Log::error('Error updating content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating content',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function newContent(){
        $division = Division::get();
        return view('admin.new_content', compact('division'));
    }

    public function createContenido(Request $request){
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'division_id' => 'required|integer|exists:division,id',
        ]);
        $name_division = Division::where('id', '=', $validated['division_id'])->pluck('division');
        try {
            $create = Informacion::create([
                'titulo' => $validated['titulo'],
                'description' => $validated['contenido'],
                'user_id' => Auth::id(), // usuario autentificado
                'division_id' => $validated['division_id'],
                'url' => str_replace(' ', '_',$name_division[0])."/".str_replace(' ', '_', $validated['titulo']),
            ]);

            return response()->json([
                'success' => true,
                'message' => $create ? 'Contenido creado exitosamente' : 'No se pudo crear contenido',
                'data' => $create
            ]);


        } catch (\Exception $e) {
            Log::error('Error al actualizar el contenido: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al actualizar el contenido.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function dashboard(Request $request){
        $soporte =  Informacion::where('division_id', '=', 1)->count();
        $redes =  Informacion::where('division_id', '=', 2)->count();
        $desarrollo =  Informacion::where('division_id', '=', 3)->count();
        $total = Informacion::count();
        return view('welcome', compact('soporte', 'redes', 'desarrollo', 'total'));
    }
    //// Logica para la version publica 
    public function index(){
        $soporte = Informacion::getSoporte();
        $redes = Informacion::getRedes();
        $desarrollo = Informacion::getDesarrollo();
        return view('pagina.home', compact('soporte', 'redes', 'desarrollo'));
    }

    public function mostrarmanual(Request $request){
        $manuales =  Informacion::manuales($request->division);
        $contenido = Informacion::manual($request->division, $request->manual);
        return view('pagina.contenido', compact('manuales', 'contenido'));
    }
}
