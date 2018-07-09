<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class SiteController extends Controller
{
    public function index()
    {
    	$productos = Producto::where('estatus','=',1)->get();

    	return view('welcome',compact('productos'));
    }
}
