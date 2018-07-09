<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;

class RestaurantController extends Controller
{
    public function productos()
    {
    	return view('panel.productos');
    }
    public function nuevoproducto()
    {
    	return view('panel.nuevoproducto');
    }
    public function storeproducto(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->user_id = Auth::user()->id;
        $producto->foto = $request->foto;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->save();

        return redirect('productos')->with('status','Producto Agregado con éxito');


    }
    public function ventas()
    {
    	return view('panel.ventas');
    }
}
