<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciudad;
use App\Categoria;

class AdminController extends Controller
{
   public function index()
   {
   	return view('admin.inicio');
   }

   public function usuarios()
   {
      $usuarios = User::all();
   	return view('admin.usuarios',compact('usuarios'));
   }

   public function categorias()
   {
      $categorias = Categoria::where('estatus','=',1)->get();
   	return view('admin.categorias',compact('categorias'));
   }

   public function borrarcategoria($id)
   {
      $categoria = Categoria::findOrFail($id);
      $categoria->estatus = 0;
      $categoria->save();

      return redirect()->back()->with('status','Categoría borrada correctamente');
   }

   public function storecategoria(Request $request)
   {

      $validatedData = $request->validate([
                'nombre' => 'unique:categorias',
                ]);


      $categoria = new Categoria();
      $categoria->nombre = $request->categoria;
      $categoria->slug = str_slug($request->nombre,'-');
      $categoria->save();

      return redirect()->back()->with('status','Categoría registrada con éxito');
   }

   public function ciudades()
   {

      $ciudades = Ciudad::where('estatus','=',1)->get();

   	return view('admin.ciudades' , compact('ciudades'));
   }

   public function borrarciudad($id)
   {


      $ciudad = Ciudad::findOrFail($id);
      $ciudad->estatus = 0;
      $ciudad->save();

      return redirect()->back()->with('status','Ciudad borrada correctamente');
   }

   public function storeciudad(Request $request)
   {
            $validatedData = $request->validate([
                'nombre' => 'unique:ciudads',
                ]);

      $ciudad = new Ciudad();
      $ciudad->nombre = $request->nombre;
      $ciudad->slug = str_slug($request->nombre , '-');
      $ciudad->save();

      return redirect()->back()->with('status','Ciudad registrada con éxito');
   }
}
