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
    public function showproducto($id)
    {
        $producto = Producto::findOrFail($id);
        return view('panel.editarproducto',compact('producto'));
    }

    public function actualizarproducto($id, Request $request)
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


        $producto = Producto::findOrFail($id);
        if ($request->hasFile('foto')) 
        {
        $producto->foto = $nombre;
        }
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->sabores = $request->sabores;
        $producto->descripcion = $request->descripcion;
        $producto->save();

        return redirect('productos')->with('status','Producto editado correctamente');

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
    public function borrarpresentaciones ($id)
    {
        $presentacion = Presentacion::findOrFail($id);
        $presentacion->delete();

        return redirect()->back()->with('status','Adicional eliminado correctamente');
    }
    public function ventas()
    {
    	return view('panel.ventas');
    }
}
