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


        $slug = str_slug($request->nombre_del_restaurante, '-');

        if(Auth::user()->tipo == 2)
        {
                $validatedData = $request->validate([
                'nombre_del_restaurante' => 'unique:users',
                'direccion' => 'required',
                'nombre_del_restaurante' => 'required',
                ]);
        }

                $validatedData = $request->validate([
                'logo' => 'image',
                'telefono' => 'required',
                ]);


        if ($request->hasFile('logo')) 
        {
        $file = $request->file('logo');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));
        }


        $user = User::findOrFail(Auth::user()->id);

        $user->telefono = $request->telefono;

        if ($request->hasFile('logo')) 
        {
            $user->logo = $nombre;
        }

        if(Auth::user()->tipo == 2){
            $user->nombre_del_restaurante = $request->nombre_del_restaurante;

            $user->direccion = $request->direccion;

            if($request->descripcion == '')
                {
                    $user->descripcion = '';
                }else{
                    $user->descripcion = $request->descripcion;
                }
            $user->slug = $slug;
        }
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
