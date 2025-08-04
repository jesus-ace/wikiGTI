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

            $updated = $contenido->update([
                'titulo' => $validated['titulo'],
                'description' => $validated['contenido'],
                'user_id' => 1, // usuario autentificado
                'division_id' => $validated['division_id'],
            ]);

            return response()->json([
                'success' => $updated,
                'message' => $updated ? 'Content updated successfully' : 'Failed to update content',
                'data' => $contenido
            ]);


        } catch (\Exception $e) {
            \Log::error('Error updating content: ' . $e->getMessage());

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

        try {
            $create = Informacion::create([
                'titulo' => $validated['titulo'],
                'description' => $validated['contenido'],
                'user_id' => 1, // usuario autentificado
                'division_id' => $validated['division_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => $create ? 'Content create successfully' : 'Failed to create content',
                'data' => $create
            ]);


        } catch (\Exception $e) {
            \Log::error('Error updating content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating content',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function mostrarmanual(){

        $manuales =  Informacion::manuales();
        $contenido = Informacion::manual();
        return view('pagina.contenido', compact('manuales', 'contenido'));
    }
}
