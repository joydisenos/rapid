<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Presentacion;

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

        if ($request->hasFile('foto')) 
        {
        $file = $request->file('foto');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));
        }


        $producto = new Producto();
        if ($request->hasFile('foto')) 
        {
        $producto->foto = $nombre;
        }else{
        $producto->foto = 'null';
        }
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->user_id = Auth::user()->id;
        $producto->descripcion = $request->descripcion;
        $producto->sabores = $request->sabores;
        $producto->save();

        return redirect('producto/presentaciones'.'/'.$producto->id)->with('status','Producto Agregado con éxito');
    }
    public function presentaciones($id)
    {
        $producto = Producto::findOrFail($id);

        return view('panel.presentaciones',compact('producto'));
    }
    public function storepresentaciones(Request $request)
    {
        $presentacion = new Presentacion();
        $presentacion->producto_id = $request->producto_id;
        $presentacion->presentacion = $request->nombre;
        $presentacion->precio = $request->precio;
        $presentacion->save();

        return redirect()->back()->with('status','Presentación Agregado con éxito');

    }
    public function ventas()
    {
    	return view('panel.ventas');
    }
}
