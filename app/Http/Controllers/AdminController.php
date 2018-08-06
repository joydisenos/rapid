<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciudad;
use App\Categoria;
use App\Categoriarest;
use App\Pedido;
use App\Preferencia;

class AdminController extends Controller
{
   public function index()
   {
   	return view('admin.inicio');
   }

   public function pedidos()
   {
      $ventas = Pedido::orderBy('id','desc')->get();
      return view('admin.pedidos',compact('ventas'));
   }

   public function usuarios()
   {
      $usuarios = User::where('tipo','=',1)->get();
      $ciudades = Ciudad::where('estatus','=',1)->get();
   	return view('admin.usuarios',compact('usuarios','ciudades'));
   }

   public function restaurantes()
   {
      $usuarios = User::where('tipo','=',2)->get();
      $ciudades = Ciudad::where('estatus','=',1)->get();
      $categorias = Categoria::where('estatus','=',1)->get();

      return view('admin.restaurantes',compact('usuarios','ciudades','categorias'));
   }

   public function categorias()
   {
      $categorias = Categoria::where('estatus','=',1)->get();
   	return view('admin.categorias',compact('categorias'));
   }

   public function asignarcategorias(Request $request)
   {
      
      $categ = Categoriarest::where('user_id','=',$request->user_id)->get();
      foreach($categ as $del)
      {
         $del->delete();
      }
      
      $categorias = $request->input('categorias');

      foreach ($categorias as $categoria) 
      {
         
                  $cat = new Categoriarest();
                  $cat->user_id = $request->user_id;
                  $cat->categoria_id = $categoria;
                  $cat->save();
      }
      return redirect()->back()->with('status','Categorias asignadas correctamente');
   

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
      $categoria->nombre = $request->nombre;
      $categoria->slug = str_slug($request->nombre,'-');
      $categoria->save();

      return redirect()->back()->with('status','Categoría registrada con éxito');
   }

   public function ciudades()
   {

      $ciudades = Ciudad::where('estatus','=',1)->get();

   	return view('admin.ciudades' , compact('ciudades'));
   }

   public function asignarciudad(Request $request)
   {
      $user = User::findOrFail($request->user_id);
      $user->ciudad = $request->ciudad;
      $user->save();
      

      return redirect()->back()->with('status','usuario '. $user->name .' asignado correctamente');
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

   public function precios()
   {
      $preferencias = Preferencia::first();
  
      if($preferencias == null)
      {
         $preferencias = new Preferencia();
         $preferencias->precio_membresia = 0;
         $preferencias->precio_destacado = 0;
         $preferencias->save();

      }
      return view('admin.precios',compact('preferencias'));
   }

   public function storeprecios(Request $request)
   {
      $preferencias = Preferencia::first();
      $preferencias->precio_membresia = $request->precio_membresia;
      $preferencias->precio_destacado = $request->precio_destacado;
      $preferencias->save();

      return redirect()->back()->with('status','Configuración guardada con éxito');
   }

   public function activar($estatus,$user)
   {
      $user = User::findOrFail($user);
      $user->estatus = $estatus;
      $user->save();

      return redirect()->back()->with('status','Restaurant Actualizado');
   }

   public function expira($user, Request $request)
   {
      $user = User::findOrFail($user);
      $user->expira = $request->fecha;
      $user->save();

      return redirect()->back()->with('status','Fecha de expiración modificada');
   }

   public function destaca($user, Request $request)
   {
      $user = User::findOrFail($user);
      $user->destacado = $request->fecha;
      $user->save();

      return redirect()->back()->with('status','Fecha de expiración modificada');
   }
}
