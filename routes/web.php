<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','SiteController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=> 'auth'],function(){
	
	Route::get('/panel', 'UserController@index');
	Route::get('/perfil', 'UserController@perfil');
	Route::get('/compras', 'UserController@compras');
	Route::get('/favoritos', 'UserController@favoritos');
	
  	
});


Route::group(['middleware'=> 'auth'],function(){
	
	Route::get('/panel', 'UserController@index');
	Route::get('/perfil', 'UserController@perfil');
	Route::get('/productos', 'RestaurantController@productos');
	Route::get('/producto/nuevo', 'RestaurantController@nuevoproducto');
	Route::post('/producto/nuevo', 'RestaurantController@storeproducto');
	Route::get('/producto/presentaciones/{id}', 'RestaurantController@presentaciones');
	Route::post('/presentacion/nuevo', 'RestaurantController@storepresentaciones');

	Route::get('/ventas', 'RestaurantController@ventas');
  	
});
