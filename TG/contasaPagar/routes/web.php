<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'App\Http\Middleware\UserGerente'], function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/usuarios', 'Auth\LoginController@usuarios');

        Route::group(['prefix' => 'contas'], function() {
            Route::group(['prefix' => 'boletos'], function () {
                Route::get('', ['as' => 'contas.boletos.index', 'uses' => 'Contas\ContasController@boletos']);
                Route::get('create', ['as' => 'contas.boletos.create', 'uses' => 'Contas\ContasController@create']);
                Route::post('store', ['as' => 'contas.boletos.store', 'uses' => 'Contas\ContasController@store']);
                Route::get('edit/{id}', ['as' => 'contas.boletos.edit', 'uses' => 'Contas\ContasController@edit']);
                Route::put('update/{id}', ['as' => 'contas.boletos.update', 'uses' => 'Contas\ContasController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.boletos.destroy', 'uses' => 'Contas\ContasController@destroy']);
            });

            Route::group(['prefix' => 'impostos'], function () {
                Route::get('', ['as' => 'contas.impostos.index', 'uses' => 'ImpostosController@index']);
            });
            Route::group(['prefix' => 'outras'], function () {
                Route::get('', ['as' => 'contas.outras.index', 'uses' => 'OutrasContasController@index']);
            });
        });
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserColaborador'], function () {
        Route::get('/logout', 'Auth\LoginController@logout');
    });

});
