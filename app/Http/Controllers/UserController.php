<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function edit(){
        $user = auth()->user();
        return view('admin.editar_usuario')->with(compact('user'));
    }

    public function update(Request $request){
        $usuario = User::find($request->id);
        if($usuario->pass == $request->pass_actual){
            $usuario->persona = $request->persona;
            $usuario->pass = $request->pass_nueva;
            $usuario->password = bcrypt($request->pass_nueva);
            $usuario->save();

            return back()->with('mensaje', 'Contraseña actualizada');
        }else{
            return back()->with('mensaje', 'La contraseña actual no coincide con la que tenía');
        }
        

    }
}
