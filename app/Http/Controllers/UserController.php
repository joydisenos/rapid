<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Direccion;
use App\Compra;
use App\Pedido;
use App\Preferencia;
use App\Ciudad;
use App\Categoria;
use App\User;
use App\Config;
use Carbon\Carbon;


 
class UserController extends Controller
{
    public function index()
    {

        $preferencias = Preferencia::first();
  
      if($preferencias == null)
      {
         $preferencias = new Preferencia();
         $preferencias->precio_membresia = 0;
         $preferencias->precio_destacado = 0;
         $preferencias->save();

      }

        if(Auth::user()->tipo == 2)

            {
                    
                    $hoy = Carbon::now(-3);
                    $hasta = new Carbon (Auth::user()->expira);
                    $expira = $hoy->diffInDays($hasta,false);

                    if($expira < 0){
                        $expira = 0;
                    }
                    
                    return view('panel.panel',compact('expira','preferencias'));
            }else{
                    return view('panel.panel','preferencias');}
    }
    public function perfil()
    {

        $categorias = Categoria::where('estatus','=',1)->get();
        $ciudades = Ciudad::where('estatus','=',1)->get();
        $preferencias = Preferencia::first();
        if(Auth::user()->tipo == 2)
        {
            $config = Config::where('user_id','=',Auth::user()->id)->first();

            if(is_null($config))
            {
                $config = new Config();
                $config->user_id = Auth::user()->id;
                $config->lunes = '00:00,00:00,00:00,00:00';
                $config->martes = '00:00,00:00,00:00,00:00';
                $config->miercoles = '00:00,00:00,00:00,00:00';
                $config->jueves = '00:00,00:00,00:00,00:00';
                $config->viernes = '00:00,00:00,00:00,00:00';
                $config->sabado = '00:00,00:00,00:00,00:00';
                $config->domingo = '00:00,00:00,00:00,00:00';
                $config->envio = 0;
                $config->save();

                $lunes = explode(',', $config->lunes);
                $martes = explode(',', $config->martes);
                $miercoles = explode(',', $config->miercoles);
                $jueves = explode(',', $config->jueves);
                $viernes = explode(',', $config->viernes);
                $sabado = explode(',', $config->sabado);
                $domingo = explode(',', $config->domingo);

                return view('panel.perfil',compact('categorias','ciudades','config','lunes','martes','miercoles','jueves','viernes','sabado','domingo','preferencias'));
            }else{
                
                $lunes = explode(',', $config->lunes);
                $martes = explode(',', $config->martes);
                $miercoles = explode(',', $config->miercoles);
                $jueves = explode(',', $config->jueves);
                $viernes = explode(',', $config->viernes);
                $sabado = explode(',', $config->sabado);
                $domingo = explode(',', $config->domingo);

                return view('panel.perfil',compact('categorias','ciudades','config','lunes','martes','miercoles','jueves','viernes','sabado','domingo','preferencias'));
            }

        }else{
        
                return view('panel.perfil',compact('categorias','ciudades','preferencias'));
            }
    }
    public function storedireccion(Request $request)
    {

        $validatedData = $request->validate([
                'alias' => 'required',
                'direccion' => 'required',
                'ciudad' => 'required',
                ]);


        $direccion = new Direccion();

        $direccion->user_id = Auth::user()->id;
        $direccion->alias = $request->alias;
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
    public function eliminarcompra($id)
    {

        $compra = Compra::findOrFail($id);
        $compra->delete();

        return redirect()->back()->with('status','Compra eliminada');
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
        $compra->precio = $request->precio;
        $compra->cantidad = $request->cantidad;
        $compra->save();

        return redirect()->back()->with('status', 'Producto agregado a su pedido');


    }

    public function checkout($slug)
    {

        $restaurant = User::where('slug','=', $slug)->first();
        $ciudades = Ciudad::where('estatus','=',1)->get();       

        return view('checkout',compact('restaurant','ciudades'));
    }

    public function pedido(Request $request)
    {


        $validatedData = $request->validate([
                'direccion' => 'required',
                'delivery' => 'required',
                'pago' => 'required',
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
        $pedido->direccion_id = $request->direccion;
        $pedido->envio = $request->envio;
        $pedido->delivery = $request->delivery;
        $pedido->pago = $request->pago;
        if($request->adicional == ''){
                $pedido->adicional = '';
            }else{
                $pedido->adicional = $request->adicional;
            }
        $pedido->total = $total + $request->envio;
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
