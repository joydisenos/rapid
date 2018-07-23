<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\User;
use App\Ciudad;
use App\Categoria;
use Illuminate\Database\Eloquent\Model;


class SiteController extends Controller
{
    public function index()
    {
    	// $restaurantes = User::where('tipo','=',2)->get();
    	// $productos = Producto::where('estatus','=',1)->take(5)->get();
    	// $destacados = User::where('tipo','=',2)->take(6)->get();
        $ciudades = Ciudad::where('estatus','=',1)->get();

    	return view('welcome',compact('ciudades'));
    }

    public function rest($slug)
    {
    	$restaurant = User::where('slug','=',$slug)->first();

    	return view('menu',compact('restaurant'));
    }

    public function ciudad(Request $request)
    {

        $ciudad = Ciudad::findOrFail($request->ciudad);

        //$destacados = User::where('tipo','=',2)->take(6)->get();

        return redirect('restaurantes'.'/'. $ciudad->slug);
    }

    public function ciudadruta($slug)
    {
        $ciudad = Ciudad::where('slug','=',$slug)->first();
        $restaurantes = User::where('tipo','=',2)->where('ciudad','=', $ciudad->id)->get();
        $categorias = Categoria::where('estatus','=',1)->get();

        return view('restaurantes',compact('restaurantes','ciudad','categorias'));

    }
    public function ciudadcategoria($ciudad , $categoria)
    {
        $ciudad = Ciudad::where('slug','=',$ciudad)->first();
        $restaurantes = User::where('tipo','=',2)->where('ciudad','=', $ciudad->id)->get();
        $categorias = Categoria::where('estatus','=',1)->get();

        return view('restaurantes',compact('restaurantes','ciudad','categorias'));
    }
}
