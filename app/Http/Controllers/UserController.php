<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	return view('panel.panel');
    }
    public function perfil()
    {
    	return view('panel.perfil');
    }
    public function compras()
    {
    	return view('panel.compras');
    }
    public function favoritos()
    {
    	return view('panel.favoritos');
    }
    
}
