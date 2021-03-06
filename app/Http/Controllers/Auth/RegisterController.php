<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/perfil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tipo' => 'required',
            'localidad' => 'required',
            'apellido' => 'required|string|min:3|max:255',
            'telefono' => 'required|numeric',
            'ciudad' => 'required',
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *  
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'tipo' => $data['tipo'],
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'telefono' => $data['telefono'],
            'localidad' => $data['localidad'],
            'nombre_del_restaurante' => '',
            'descripcion' => '',
            'logo' => '',
            'slug' => '',
            'categorias' => '',
            'direccion' => '',
            'ciudad' => $data['ciudad'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'expira' => Carbon::now(-3)->addDays(16),
        ]);
    }
}
