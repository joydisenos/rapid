<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Direccion;
use App\Compra;
use App\Pedido;
use App\Categoria;
use App\User;


class UserController extends Controller
{
    public function index()
    {
    	return view('panel.panel');
    }
    public function perfil()
    {

        $categorias = Categoria::where('estatus','=',1)->get();
        

    	return view('panel.perfil',compact('categorias'));
    }
    public function storedireccion(Request $request)
    {
        $direccion = new Direccion();

        $direccion->user_id = Auth::user()->id;
        $direccion->direccion = $request->direccion;
        $direccion->ciudad = $request->ciudad;
        if($request->barrio == '')
        {
         $direccion->barrio = '';   
        }else{
                $direccion->barrio = $request->barrio;
            }
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

            /* if(empty($request->categorias)){

            }else{
                $categorias = implode(',', $request->categorias);
                $user->categorias = $categorias;
            }*/

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

    public function compra(Request $request)
    {
   

        $validatedData = $request->validate([
                'cantidad' => 'required',
                ]);


        $compra = new Compra();
        if ($request->has('sabores'))
            {
                if(empty($request->sabores)){
                    $compra->sabores = '';
                }else{
                                $sabores = implode(',', $request->sabores);
                                $compra->sabores = $sabores;
                            }
            }else{
                $compra->sabores = '';
            }
        if ($request->has('adicionales'))
        {
            if(empty($request->adicionales)){
                $compra->adicionales = '';
            }else{
                        $adicionales = implode(',', $request->adicionales);
                        $compra->adicionales = $adicionales;
                    }
        }else{
            $compra->adicionales = '';
        } 
        $compra->producto_id = $request->producto_id;
        $compra->user_id = Auth::user()->id;
        $compra->restaurant_id = $request->restaurant_id;
        $compra->pedido_id = 0;
        $compra->precio = 0;
        $compra->cantidad = $request->cantidad;
        $compra->save();

        return redirect()->back()->with('status', 'Compra registrada con éxito');


    }

    public function checkout($slug)
    {

        $restaurant = User::where('slug','=', $slug)->first();       

        return view('checkout',compact('restaurant'));
    }

    public function pedido(Request $request)
    {


        $validatedData = $request->validate([
                'direccion' => 'required',
                'delivery' => 'required',
                ]);


        // Variables de Compra
        $total = 0;

        $compras = Compra::where('pedido_id','=',0)
                        ->where('restaurant_id','=',$request->restaurant_id)
                        ->get();

        foreach ($compras as $key => $compra) {
            $total = $total + $compra->precio;
        }

        

        $pedido = new Pedido();
        $pedido->user_id = Auth::user()->id;
        $pedido->restaurant_id = $request->restaurant_id;
        $pedido->envio = $request->envio;
        $pedido->delivery = $request->delivery;
        if($request->adicional == ''){
                $pedido->adicional = '';
            }else{
                $pedido->adicional = $request->adicional;
            }
        $pedido->total = $total;
        $pedido->save();

        foreach ($compras as $key => $compra) {
            $compra->pedido_id = $pedido->id;
            $compra->save();
        }


        
       
        return Redirect::to('compras')->with('pedido',$pedido);
    }


    public function favoritos()
    {
    	return view('panel.favoritos');
    }
    
}
