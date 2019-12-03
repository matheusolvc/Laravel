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

Route::get('/contas/impostos', function () {
    return view('contas.impostos.index');
});

Route::get('/contas/boletos', function () {
    return view('contas.boletos.index');
});

Route::get('/contas/outras', function () {
    return view('contas.outras.index');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::group(['prefix' => 'contas', 'middleware' => 'auth'], function () {

//     Route::group(['prefix' => 'boletos'], function () {
//         Route::get('', ['as' => 'contas.boletos.index', 'uses' => 'BoletosController@index']);
//     });
//     Route::group(['prefix' => 'impostos'], function () {
//         Route::get('', ['as' => 'contas.impostos.index', 'uses' => 'ImpostosController@index']);
//     });
//     Route::group(['prefix' => 'outras'], function () {
//         Route::get('', ['as' => 'contas.outras.index', 'uses' => 'OutrasContasController@index']);
//     });
// });
