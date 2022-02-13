<?php

use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// r95 03/06/2021 21:18
// Route::resource('ESTADO', 'ESTADOController'); 
// Route::get('traer_estados', 'ESTADOController@traer_estados'); 

// rc95 08/06/2021 01:10
Route::get('traer_estados', 'TablasController@traer_estados'); 
Route::get('traer_roles', 'TablasController@traer_roles'); 
Route::get('traer_empresas', 'TablasController@traer_empresas');  // rc95 08/06/2021 01:33

Route::get('traer_tablas', 'TablasController@traer_tablas');  // rc95 08/06/2021 01:33

Route::get('comprobar_login', 'TablasController@comprobar_login');  //rc95 12/02/2022 17:01 - estamos reemplazando el login original por el artesanal.

Route::get('crear_rol', 'TablasController@crear_rol'); 
Route::get('editar_rol', 'TablasController@editar_rol'); 
Route::get('eliminar_rol', 'TablasController@eliminar_rol'); 

//rc95 13/02/2022 11:03
Route::get('crear_estado', 'TablasController@crear_estado'); 
Route::get('editar_estado', 'TablasController@editar_estado'); 
Route::get('eliminar_estado', 'TablasController@eliminar_estado'); 

Route::get('crear_empresa', 'TablasController@crear_empresa'); 
Route::get('editar_empresa', 'TablasController@editar_empresa'); 
Route::get('eliminar_empresa', 'TablasController@eliminar_empresa'); 

Route::get('traer_tipo_documentos', 'TablasController@traer_tipo_documentos'); 
Route::get('crear_tipo_documento', 'TablasController@crear_tipo_documento'); 
Route::get('editar_tipo_documento', 'TablasController@editar_tipo_documento'); 
Route::get('eliminar_tipo_documento', 'TablasController@eliminar_tipo_documento'); 

Route::get('traer_tipo_tickets', 'TablasController@traer_tipo_tickets'); 
Route::get('crear_tipo_ticket', 'TablasController@crear_tipo_ticket'); 
Route::get('editar_tipo_ticket', 'TablasController@editar_tipo_ticket'); 
Route::get('eliminar_tipo_ticket', 'TablasController@eliminar_tipo_ticket'); 

Route::get('traer_proveedores', 'TablasController@traer_proveedores'); 
Route::get('crear_proveedor', 'TablasController@crear_proveedor'); 
Route::get('editar_proveedor', 'TablasController@editar_proveedor'); 
Route::get('eliminar_proveedor', 'TablasController@eliminar_proveedor'); 

//rc95 13/02/2022 13:46
Route::get('traer_personas', 'TablasController@traer_personas'); 
Route::get('crear_persona', 'TablasController@crear_persona'); 
Route::get('editar_persona', 'TablasController@editar_persona'); 
Route::get('eliminar_persona', 'TablasController@eliminar_persona'); 

// Route::get('traer_usuarios', 'TablasController@traer_usuarios'); 
// Route::get('crear_usuario', 'TablasController@crear_usuario'); 
// Route::get('editar_usuario', 'TablasController@editar_usuario'); 
// Route::get('eliminar_usuario', 'TablasController@eliminar_usuario'); 

// Route::resource('prueba', 'PruebaController'); 
Route::get('prueba_1', 'PruebaController@prueba_1'); 

// Route::group(['middleware' => ['cors']], function () {
//     //Rutas a las que se permitirá acceso
//     // r95 05/06/2021 13:16
//     Route::post('/login', 'Api\V1\Auth\LoginController');
//     Route::post('/register', 'Api\V1\Auth\RegisterController');
//     Route::post('/logout', 'Api\V1\Auth\LogoutController')->middleware('auth:api');
//     Route::post('/password-forgot', 'Api\V1\Auth\ForgotPasswordController');
//     Route::post('/password-reset', 'Api\V1\Auth\ResetPasswordController');
// });

// Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
    Route::post('/login', 'LoginController');
    Route::post('/register', 'RegisterController');
    Route::post('/logout', 'LogoutController')->middleware('auth:api');
    Route::post('/password-forgot', 'ForgotPasswordController');
    Route::post('/password-reset', 'ResetPasswordController');
});

// // r95 05/06/2021 13:16
// Route::post('login', 'Api\V1\Auth\LoginController');
// Route::post('register', 'Api\V1\Auth\RegisterController');
// Route::post('logout', 'Api\V1\Auth\LogoutController')->middleware('auth:api');
// Route::post('password-forgot', 'Api\V1\Auth\ForgotPasswordController');
// Route::post('password-reset', 'Api\V1\Auth\ResetPasswordController');


JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
    $api->get('me', 'Api\V1\MeController@readProfile');
    $api->patch('me', 'Api\V1\MeController@updateProfile');

    $api->resource('users');
});
