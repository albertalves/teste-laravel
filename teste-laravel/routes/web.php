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

Route::get('/', function () {
    return view('admin.painel');
});

Route::prefix('painel')->group(function(){
    Route::get('/', 'Admin\PainelController@index')->name('painel');

    Route::get('login', 'Auth\LoginController@index')->name('login');
    Route::post('login', 'Auth\LoginController@authenticate');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@index')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::Resource('user', 'Admin\UserController');
    
    Route::Resource('participante', 'Pessoa\PessoaController');

    Route::Resource('grupo', 'Grupo\GrupoController');
});