<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\User;
use App\Config;
use App\Ciudad;
use App\Categoria;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class SiteController extends Controller
{
    public function index()
    {
    	// $restaurantes = User::where('tipo','=',2)->get();
    	// $productos = Producto::where('estatus','=',1)->take(5)->get();
    	// $destacados = User::where('tipo','=',2)->take(6)->get();
        $ciudades = Ciudad::where('estatus','=',1)->orderBy('nombre')->get();

    	return view('welcome',compact('ciudades'));
    }

    public function alta()
    {
        return view('alta');
    }

    public function rest($slug)
    {
        $restaurant = User::where('slug','=',$slug)->first();
    	$config = Config::where('user_id','=',$restaurant->id)->first();
        $hoy = Carbon::now(-3);
        $dia = Carbon::now(-3)->format('l');
        $hora = Carbon::now(-3)->format('H:i');

                $lunes = explode(',', $config->lunes);
                $martes = explode(',', $config->martes);
                $miercoles = explode(',', $config->miercoles);
                $jueves = explode(',', $config->jueves);
                $viernes = explode(',', $config->viernes);
                $sabado = explode(',', $config->sabado);
                $domingo = explode(',', $config->domingo);


       
        switch ($dia) {
            case 'Monday':
                if(Carbon::createFromFormat('H:i', $lunes[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $lunes[1])->format('H:i') || Carbon::createFromFormat('H:i', $lunes[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $lunes[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Tuesday':
                if(Carbon::createFromFormat('H:i', $martes[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $martes[1])->format('H:i') || Carbon::createFromFormat('H:i', $martes[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $martes[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Wednesday':
                if(Carbon::createFromFormat('H:i', $miercoles[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $miercoles[1])->format('H:i') || Carbon::createFromFormat('H:i', $miercoles[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $miercoles[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Thursday':

                if( Carbon::createFromFormat('H:i', $jueves[0])->format('H:i') <= $hora && $hora <= Carbon::createFromFormat('H:i', $jueves[1])->format('H:i')  ||  Carbon::createFromFormat('H:i', $jueves[2])->format('H:i') <= $hora && $hora <= Carbon::createFromFormat('H:i', $jueves[3])->format('H:i') ){
                        $abierto = 1;    
                }else{
                    
                        $abierto = 0;
                }
                
                break;

            case 'Friday':
                if(Carbon::createFromFormat('H:i', $viernes[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $viernes[1])->format('H:i') || Carbon::createFromFormat('H:i', $viernes[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $viernes[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Saturday':
                if(Carbon::createFromFormat('H:i', $sabado[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $sabado[1])->format('H:i')  ||  Carbon::createFromFormat('H:i', $sabado[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $sabado[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Sunday':
                if(Carbon::createFromFormat('H:i', $domingo[0])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $domingo[1])->format('H:i')  || Carbon::createFromFormat('H:i', $domingo[2])->format('H:i') <= $hora && $hora < Carbon::createFromFormat('H:i', $domingo[3])->format('H:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;
            
            default:
                $abierto = 0;
                break;
        }

    	return view('menu',compact('restaurant','hoy','abierto','lunes','martes','miercoles','jueves','viernes','sabado','domingo'));
    }

    public function ciudad(Request $request)
    {

        $ciudad = Ciudad::findOrFail($request->ciudad);

        //$destacados = User::where('tipo','=',2)->take(6)->get();

        return redirect('restaurantes'.'/'. $ciudad->slug);
    }

    public function ciudadruta($slug)
    {
        $hoy = Carbon::now(-3)->format('Y-m-d');
        $ciudad = Ciudad::where('slug','=', $slug)->first();
        $restaurantes = User::where('tipo','=',2)->where('ciudad','=', $ciudad->id )->where('expira','>', $hoy)->where('estatus','=',1)->get();
        $destacados = User::where('tipo','=',2)->where('ciudad','=', $ciudad->id )->where('expira','>', $hoy)->where('destacado','>',$hoy)->where('estatus','=',1)->get();
        $categorias = Categoria::where('estatus','=',1)->get();

        return view('restaurantes',compact('restaurantes','ciudad','categorias','hoy','destacados'));

    }
    public function ciudadcategoria($ciudad , $categoria)
    {
        $ciudad = Ciudad::where('slug','=',$ciudad)->first();
        $restaurantes = User::where('tipo','=',2)->where('ciudad','=', $ciudad->id)->get();
        $categorias = Categoria::where('estatus','=',1)->get();

        return view('restaurantes',compact('restaurantes','ciudad','categorias'));
    }
}
