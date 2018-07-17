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

        

        
        $validatedData = $request->validate([
                'nombre' => 'required|string|min:3',
                'precio' => 'required|numeric',
                ]);
        if ($request->hasFile('foto'))
        {
            $validatedData = $request->validate([
                'foto' => 'image',
                ]);
        }

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
        $producto->foto = '';
        }
        
        $producto->nombre = $request->nombre;
        
        $producto->precio = $request->precio;
        
        $producto->categoria_id = $request->categoria_id;
        
        $producto->user_id = Auth::user()->id;
        
        if($request->descripcion == '')
        {
            $producto->descripcion = '';
        }else{
            $producto->descripcion = $request->descripcion;    
        }
        if($request->sabores == ''){
            $producto->sabores = '';    
        }else{
            $producto->sabores = $request->sabores;
        }
        $producto->save();


        

        if ($request->adicional == '')
        {}
        else 
        {

            $adicionales = array_combine($request->adicional,$request->precio_adicional);

            foreach($adicionales as $adicional => $adicional_precio)
            {
                $presentacion = new Presentacion();
                $presentacion->producto_id = $producto->id;
                $presentacion->presentacion = $adicional;
                $presentacion->precio = $adicional_precio;
                $presentacion->save();
            }
            
        }
       



        return redirect('productos')->with('status','Producto Agregado con éxito');
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
