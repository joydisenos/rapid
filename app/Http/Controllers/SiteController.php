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
        $ciudades = Ciudad::where('estatus','=',1)->get();

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
        $hora = Carbon::now(-3)->format('h:i');
                $lunes = explode(',', $config->lunes);
                $martes = explode(',', $config->martes);
                $miercoles = explode(',', $config->miercoles);
                $jueves = explode(',', $config->jueves);
                $viernes = explode(',', $config->viernes);
                $sabado = explode(',', $config->sabado);
                $domingo = explode(',', $config->domingo);


        
        switch ($dia) {
            case 'Monday':
                if(Carbon::createFromFormat('h:i', $lunes[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $lunes[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Tuesday':
                if(Carbon::createFromFormat('h:i', $martes[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $martes[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Wednesday':
                if(Carbon::createFromFormat('h:i', $miercoles[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $miercoles[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Thursday':
                if(Carbon::createFromFormat('h:i', $jueves[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $jueves[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Friday':
                if(Carbon::createFromFormat('h:i', $viernes[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $viernes[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Saturday':
                if(Carbon::createFromFormat('h:i', $sabado[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $sabado[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;

            case 'Sunday':
                if(Carbon::createFromFormat('h:i', $domingo[0])->format('h:i') <= $hora && $hora < Carbon::createFromFormat('h:i', $domingo[1])->format('h:i')){
                        $abierto = 1;    
                }else{
                        $abierto = 0;
                }
                
                break;
            
            default:
                $abierto = 0;
                break;
        }

    	return view('menu',compact('restaurant','hoy','abierto'));
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
