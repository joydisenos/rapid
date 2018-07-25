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
Route::get('/alta','SiteController@alta');
Route::post('/restaurantes','SiteController@ciudad');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/restaurant/{slug}', 'SiteController@rest');
Route::get('/restaurantes/{ciudad}/{categoria}', 'SiteController@rest');
Route::get('/restaurantes/{slug}', 'SiteController@ciudadruta');
Route::get('/restaurantes/{ciudad}/{categoria}', 'SiteController@ciudadcategoria');



// Cliente
Route::group(['middleware'=> 'auth'],function(){
	
	Route::get('/panel', 'UserController@index');
	Route::get('/perfil', 'UserController@perfil');
	Route::get('/compras', 'UserController@compras');
	Route::get('/compra/eliminar/{id}', 'UserController@eliminarcompra');
	Route::get('/favoritos', 'UserController@favoritos');
	Route::post('/direccion/nueva', 'UserController@storedireccion');
	Route::post('/actualizar/usuario', 'UserController@actualizar');
	Route::post('/nueva/compra', 'UserController@compra');
	Route::get('/checkout/{slug}', 'UserController@checkout');	
	Route::post('/checkout', 'UserController@pedido');	
  	
});

// Restaurant
Route::group(['middleware'=> 'auth'],function(){
	
	Route::get('/panel', 'UserController@index');
	Route::get('/perfil', 'UserController@perfil');
	Route::get('/productos', 'RestaurantController@productos');
	Route::get('/producto/nuevo', 'RestaurantController@nuevoproducto');
	Route::post('/producto/nuevo', 'RestaurantController@storeproducto');
	Route::get('/producto/presentaciones/{id}', 'RestaurantController@presentaciones');
	Route::post('/presentacion/nuevo', 'RestaurantController@storepresentaciones');
	Route::get('/presentacion/del/{id}', 'RestaurantController@borrarpresentaciones');
	Route::get('/producto/edit/{id}', 'RestaurantController@showproducto');
	Route::post('/producto/edit/{id}', 'RestaurantController@actualizarproducto');

	Route::get('/ventas', 'RestaurantController@ventas');
  	
});


// Admin
Route::group(['middleware'=> 'auth'],function(){
	Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index');
    Route::get('/usuarios', 'AdminController@usuarios');
    Route::get('/categorias', 'AdminController@categorias');
    Route::get('borrar/categoria/{id}', 'AdminController@borrarcategoria');
    Route::get('borrar/ciudad/{id}', 'AdminController@borrarciudad');
    Route::get('/ciudades', 'AdminController@ciudades');
    Route::post('/categoria', 'AdminController@storecategoria');
    Route::post('/ciudad', 'AdminController@storeciudad');

});  	
});
