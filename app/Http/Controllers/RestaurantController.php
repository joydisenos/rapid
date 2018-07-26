<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Pedido;
use App\Config;
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

    public function actualizarventa($id, $estatus)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estatus = $estatus;
        $pedido->save();

        return redirect()->back()->with('status','Pedido Marcado como Entregado');
    }

    public function actualizarhorario(Request $request)
    {

                $lunes = implode(',', $request->lunes);
                $martes = implode(',', $request->martes);
                $miercoles = implode(',', $request->miercoles);
                $jueves = implode(',', $request->jueves);
                $viernes = implode(',', $request->viernes);
                $sabado = implode(',', $request->sabado);
                $domingo = implode(',', $request->domingo);


        $config = Config::where('user_id','=',Auth::user()->id)->first();

                $config->lunes = $lunes;
                $config->martes = $martes;
                $config->miercoles = $miercoles;
                $config->jueves = $jueves;
                $config->viernes = $viernes;
                $config->sabado = $sabado;
                $config->domingo = $domingo;
                $config->envio = $request->envio;
                if($request->has('domicilio'))
                {
                    $config->domicilio = 1;
                }else{
                    $config->domicilio = 0;
                }
                if($request->has('local'))
                {
                    $config->local = 1;
                }else{
                    $config->local = 0;
                }
                if($request->has('tarjetadelivery'))
                {
                    $config->tarjetadelivery = 1;
                }else{
                    $config->tarjetadelivery = 0;
                }
                if($request->has('efectivodelivery'))
                {
                    $config->efectivodelivery = 1;
                }else{
                    $config->efectivodelivery = 0;
                }
                $config->save();

                return redirect()->back()->with('status','Datos actualizados correctamente');
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
        if($request->sabores == '')
            {
                $producto->sabores = '';
            }else{
                $producto->sabores = $request->sabores;
            }
        if($request->descripcion = ''){
            $producto->descripcion = '';
        }else{
                $producto->descripcion = $request->descripcion;}
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
