<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Direccion;
use App\User;


class UserController extends Controller
{
    public function index()
    {
    	return view('panel.panel');
    }
    public function perfil()
    {
    	return view('panel.perfil');
    }
    public function storedireccion(Request $request)
    {
        $direccion = new Direccion();

        $direccion->user_id = Auth::user()->id;
        $direccion->direccion = $request->direccion;
        $direccion->ciudad = $request->ciudad;
        $direccion->barrio = $request->barrio;
        $direccion->save();

        return redirect()->back()->with('status','Dirección registrada con éxito');

    }
    public function actualizar(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->telefono = $request->telefono;
        $user->save();

        return redirect()->back()->with('status','Datos actualizados Correctamente');
    }
    public function compras()
    {
    	return view('panel.compras');
    }
    public function favoritos()
    {
    	return view('panel.favoritos');
    }
    
}
