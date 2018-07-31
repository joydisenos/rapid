<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Pedido;
use App\Pago;
use App\Config;
use App\User;
use Carbon\Carbon;
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

    public function membresia(Request $request,$estatus)

    {
        if($estatus == 'aprobado')
            {
                $preferencias = Preferencia::first();
                $monto = $preferencias->precio_membresia;
                $user = User::findOrFail(Auth::user()->id);
                
                $expira = new Carbon($user->expira);
                
                $user->expira = $expira->addMonth();

                $user->prueba = 2;
                
                $user->save();

                $pago = new Pago();
                $pago->user_id = Auth::user()->id;
                $pago->concepto = 'Pago de Membresía';
                $pago->monto = (float)$monto;
                $pago->save();

                
                return redirect('panel')->with('status','pago realizado con éxito, su número de referencia es: '. $pago->id);
            }
        elseif($estatus == 'fail')
        {
            return redirect('panel')->with('error','Hubo un error en la operación por favor intente nuevamente');
        }
        elseif($estatus == 'pendiente')
        {
            return redirect('panel')->with('status','Su pago se encuentra pendiente por ejecutar');
        }
    }

    public function destacado (Request $request , $estatus)

    {
        if($estatus == 'aprobado')
            {
                $user = User::findOrFail(Auth::user()->id);
                
                $destacado = Carbon::now(-3);
                
                $user->destacado = $destacado->addDays(30);
                
                $user->save();

                
                return redirect('perfil')->with('status','Transacción exitosa');
            }
        elseif($estatus == 'fail')
        {
            return redirect('perfil')->with('error','Hubo un error en la operación por favor intente nuevamente');
        }
        elseif($estatus == 'pendiente')
        {
            return redirect('perfil')->with('status','Su pago se encuentra pendiente por ejecutar');
        }
    }


    public function activarproducto($id,$estatus)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = $estatus;
        $producto->save();

        return redirect()->back()->with('status','Cambio de estado al producto: '.title_case($producto->nombre));

    }
    public function showproducto($id)
    {
        $producto = Producto::findOrFail($id);
        return view('panel.editarproducto',compact('producto'));
    }

    public function actualizarventa($id, Request $request)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estatus = $request->entrega;
        $pedido->save();

        return redirect()->back()->with('status','Pedido Marcado como Entregado');
    }

    public function horario ()

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

                return view('panel.horario',compact('config','lunes','martes','miercoles','jueves','viernes','sabado','domingo'));
            }else{
                
                $lunes = explode(',', $config->lunes);
                $martes = explode(',', $config->martes);
                $miercoles = explode(',', $config->miercoles);
                $jueves = explode(',', $config->jueves);
                $viernes = explode(',', $config->viernes);
                $sabado = explode(',', $config->sabado);
                $domingo = explode(',', $config->domingo);

                return view('panel.horario',compact('config','lunes','martes','miercoles','jueves','viernes','sabado','domingo'));
            }

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
                $config->enviomodo = $request->enviomodo;
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
                if($request->has('efectivolocal'))
                {
                    $config->efectivolocal = 1;
                }else{
                    $config->efectivolocal = 0;
                }
                if($request->has('tarjetalocal'))
                {
                    $config->tarjetalocal = 1;
                }else{
                    $config->tarjetalocal = 0;
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
        $ventas = Pedido::where('restaurant_id','=', Auth::user()->id)->orderBy('id','desc')->get();
    	return view('panel.ventas',compact('ventas'));
    }
}
