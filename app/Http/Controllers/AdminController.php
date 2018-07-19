<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
      $categorias = Categoria::all();
   	return view('admin.categorias',compact('categorias'));
   }

   public function borrarcategoria($id)
   {
      $categoria = Categoria::findOrFail($id);
      $categoria->delete();

      return redirect()->back()->with('status','Categoría borrada correctamente');
   }

   public function storecategoria(Request $request)
   {
      $categoria = new Categoria();
      $categoria->nombre = $request->categoria;
      $categoria->save();

      return redirect()->back()->with('status','Categoría registrada con éxito');
   }

   public function ciudades()
   {
   	return view('admin.ciudades');
   }
}
