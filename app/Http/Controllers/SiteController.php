<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\User;
use Illuminate\Database\Eloquent\Model;


class SiteController extends Controller
{
    public function index()
    {
    	$restaurantes = User::where('tipo','=',2)->get();
    	$productos = Producto::where('estatus','=',1)->take(5)->get();
    	$destacados = User::where('tipo','=',2)->take(6)->get();

    	return view('welcome',compact('restaurantes','productos','destacados'));
    }
}
