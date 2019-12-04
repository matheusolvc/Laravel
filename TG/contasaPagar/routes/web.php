<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'App\Http\Middleware\UserGerente'], function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/usuarios', 'Auth\LoginController@usuarios');

        Route::group(['prefix' => 'contas'], function() {
            Route::get('pagar/{id}/{redirect}', ['as' => 'contas.pagar', 'uses' => 'Contas\ContasController@pagar']);

            Route::group(['prefix' => 'boletos', 'namespace' => 'Contas'], function () {
                Route::get('', ['as' => 'contas.boletos.index', 'uses' => 'BoletosController@index']);
                Route::get('create', ['as' => 'contas.boletos.create', 'uses' => 'BoletosController@create']);
                Route::post('store', ['as' => 'contas.boletos.store', 'uses' => 'BoletosController@store']);
                Route::get('edit/{id}', ['as' => 'contas.boletos.edit', 'uses' => 'BoletosController@edit']);
                Route::put('update/{id}', ['as' => 'contas.boletos.update', 'uses' => 'BoletosController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.boletos.destroy', 'uses' => 'BoletosController@destroy']);
            });

            Route::group(['prefix' => 'impostos', 'namespace' => 'Contas'], function () {
                Route::get('', ['as' => 'contas.boletos.index', 'uses' => 'ImpostosController@index']);
                Route::get('create', ['as' => 'contas.boletos.create', 'uses' => 'ImpostosController@create']);
                Route::post('store', ['as' => 'contas.boletos.store', 'uses' => 'ImpostosController@store']);
                Route::get('edit/{id}', ['as' => 'contas.boletos.edit', 'uses' => 'ImpostosController@edit']);
                Route::put('update/{id}', ['as' => 'contas.boletos.update', 'uses' => 'ImpostosController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.boletos.destroy', 'uses' => 'ImpostosController@destroy']);
            });

            Route::group(['prefix' => 'outras', 'namespace' => 'Contas'], function () {
                Route::get('', ['as' => 'contas.boletos.index', 'uses' => 'OutrasController@index']);
                Route::get('create', ['as' => 'contas.boletos.create', 'uses' => 'OutrasController@create']);
                Route::post('store', ['as' => 'contas.boletos.store', 'uses' => 'OutrasController@store']);
                Route::get('edit/{id}', ['as' => 'contas.boletos.edit', 'uses' => 'OutrasController@edit']);
                Route::put('update/{id}', ['as' => 'contas.boletos.update', 'uses' => 'OutrasController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.boletos.destroy', 'uses' => 'OutrasController@destroy']);
            });
        });

        Route::group(['prefix' => 'reembolso', 'namespace' => 'Reembolso'], function () {
            Route::get('', ['as' => 'reembolso.index', 'uses' => 'ReembolsoController@index']);
            Route::get('create', ['as' => 'reembolso.create', 'uses' => 'ReembolsoController@create']);
            Route::post('store', ['as' => 'reembolso.store', 'uses' => 'ReembolsoController@store']);
            Route::get('edit/{id}', ['as' => 'reembolso.edit', 'uses' => 'ReembolsoController@edit']);
            Route::put('update/{id}', ['as' => 'reembolso.update', 'uses' => 'ReembolsoController@update']);
            Route::get('destroy/{id}', ['as' => 'reembolso.destroy', 'uses' => 'ReembolsoController@destroy']);
        });

    });



    Route::group(['middleware' => 'App\Http\Middleware\UserColaborador'], function () {
        Route::get('/logout', 'Auth\LoginController@logout');
    });

});
