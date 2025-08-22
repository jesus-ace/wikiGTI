<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\User;
use App\Models\Division;

class UsuariosController extends Controller
{
    public function userList(){
        $data = User::listUser();
        return view('admin.user.usuarioslist', compact('data'));
    }

    public function userRegister(){
        $division = Division::get();
        $rol = Roles::get();
        return view('admin.user.registro', compact('division', 'rol'));
    }
    // Busaqueda por Ldap

    private function _OnConn(){
		$cn1 = ldap_connect(env('SERVERLDAP'),env('portLDAP'));
		ldap_set_option($cn1, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_bind($cn1, env('LdapLogin'), env('pwdLDAP'));
		return $cn1;
	}

    public function _findUserAdd(Request $request){
        try {
            $user = User::where('cedula', '=', $request->cedula)->first();
            if (isset($user)) {
                return json_encode(['status' => FALSE, 'msj' => "El usuaria ya se encuentra registrado"]);
            }
            $base= env('basednLDAP');
            $cnn = $this->_OnConn();
            $filtro="(|(employeenumber=$request->cedula))";
            $justthese = array("employeenumber","uid","userPassword","givenname","sn","sambauserworkstations"); // campos a traer
            $sr = ldap_search($cnn, $base, $filtro, $justthese);
            
            $count = ldap_count_entries($cnn, $sr);
        
            if ($count){
                $perfil = ldap_get_entries($cnn, $sr);
                $acounts = array();
                for($i=0;$i<$count;$i++){
                    $p=$perfil[$i]["uid"][0];
                    $fr="(|(uid=$p))";
                    $je = array("uid");
                    $sd = ldap_search($cnn, $base, $fr, $je);
                    $entry = ldap_first_entry($cnn, $sd);
                    $acounts["dn"] = ldap_get_dn($cnn, $entry);
                    $acounts["ci"] = $perfil[$i]["employeenumber"][0];
                    $acounts["login"] = $perfil[$i]["uid"][0];
                    $acounts["nombre"] = $perfil[$i]["givenname"][0];
                    $acounts["apellido"] = $perfil[$i]["sn"][0];
                    $acounts["password"] =  $perfil[$i]["userpassword"][0];

                }
                return json_encode($acounts);
            }else{
                return FALSE;
            }
        } catch (\Exeption $e) {
            return $e;
        }
        
    }

    public function registroUser(Request $request){

        try {
            $buscar_user =  User::where('cedula', '=', $request->cedula)->first();
            if (!isset($buscar_user)) {
                User::create([
                    'cedula' => $request->cedula,
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'username' => $request->username,
                    'email' => $request->correo,
                    'rol_id' => $request->rol,
                    'division_id' => $request->division,
                    'password' => $request->cedula
                ]);
                
                return json_encode(['status' => true]);
            }
            return json_encode(['status' => false]);
        } catch (\Exeption $e) {
            return $e;
        }
        
    }

    public function formEditarUsuario(Request $request){
        try {
            $data =  User::where('cedula', '=', $request->cedula)->first();
            $division = Division::get();
            $rol = Roles::get();
            return view('admin.user.editar', compact('data', 'division', 'rol'));

        } catch (\Exeption $e) {
            return $e;
        }
    }

    public function editarUsuario (Request $request){
        try {
            $buscar_user =  User::where('cedula', '=', $request->cedula)->first();
            if(isset($buscar_user)){
                $buscar_user->update([
                    'cedula' => $request->cedula,
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'username' => $request->username,
                    'email' => $request->email,
                    'rol_id' => $request->rol_id,
                    'division_id' => $request->division_id,
                    'password' => $request->password,
                ]);
                return json_encode(['status' => true, 'data' => $buscar_user]);
            }

            return json_encode(['status' => false, 'msj' => 'Usuario no existe']);
            
        } catch (\Exeption $e) {
            return $e;
        }
    }
}
