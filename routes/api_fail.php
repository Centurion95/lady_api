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
/*
Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
    Route::post('/login', 'LoginController');
    Route::post('/register', 'RegisterController');
    Route::post('/logout', 'LogoutController')->middleware('auth:api');
    Route::post('/password-forgot', 'ForgotPasswordController');
    Route::post('/password-reset', 'ResetPasswordController');
});
*/

// // r95 05/06/2021 13:16
 Route::post('login', 'Api\V1\Auth\LoginController');
// Route::post('register', 'Api\V1\Auth\RegisterController');
// Route::post('logout', 'Api\V1\Auth\LogoutController')->middleware('auth:api');
// Route::post('password-forgot', 'Api\V1\Auth\ForgotPasswordController');
// Route::post('password-reset', 'Api\V1\Auth\ResetPasswordController');


JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
    $api->get('me', 'Api\V1\MeController@readProfile');
    $api->patch('me', 'Api\V1\MeController@updateProfile');

    $api->resource('users');
});
