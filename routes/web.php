<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(Auth::check()){
        return view('users.user');
    }
    return view('welcome');
});

// rutas de validacion
Route::get('/usuario-validar/{id}','Auth\RegisterController@validateUser')->name('validateUser');
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
 });
Auth::routes();

//rutas generales del sistema
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/usuario','UserController')->name('*','users');
    Route::get('/usuarios','UserController@getUsers')->name('users.all');
    Route::post('/usuarios/update/{id}','UserController@update');
    Route::post('/usuario/delete/{id}','UserController@destroy');
    Route::get('/usuario/familia/{id}','CoreController@familyStructure');
    Route::get('/usuario/familia/agregar/{id}','CoreController@familyStructureNew');
    Route::post('/usuario/familia/guardar/{id}','CoreController@familyStructureSave');
});

