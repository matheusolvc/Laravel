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
                Route::get('', ['as' => 'contas.impostos.index', 'uses' => 'ImpostosController@index']);
                Route::get('create', ['as' => 'contas.impostos.create', 'uses' => 'ImpostosController@create']);
                Route::post('store', ['as' => 'contas.impostos.store', 'uses' => 'ImpostosController@store']);
                Route::get('edit/{id}', ['as' => 'contas.impostos.edit', 'uses' => 'ImpostosController@edit']);
                Route::put('update/{id}', ['as' => 'contas.impostos.update', 'uses' => 'ImpostosController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.impostos.destroy', 'uses' => 'ImpostosController@destroy']);
            });

            Route::group(['prefix' => 'outras', 'namespace' => 'Contas'], function () {
                Route::get('', ['as' => 'contas.outras.index', 'uses' => 'OutrasController@index']);
                Route::get('create', ['as' => 'contas.outras.create', 'uses' => 'OutrasController@create']);
                Route::post('store', ['as' => 'contas.outras.store', 'uses' => 'OutrasController@store']);
                Route::get('edit/{id}', ['as' => 'contas.outras.edit', 'uses' => 'OutrasController@edit']);
                Route::put('update/{id}', ['as' => 'contas.outras.update', 'uses' => 'OutrasController@update']);
                Route::get('destroy/{id}', ['as' => 'contas.outras.destroy', 'uses' => 'OutrasController@destroy']);
            });
        });

        Route::group(['prefix' => 'reembolso', 'namespace' => 'Reembolso'], function () {
            Route::get('', ['as' => 'reembolso.index', 'uses' => 'ReembolsoController@index']);
            Route::get('solicitacoes', ['as' => 'reembolso.solicitacoes', 'uses' => 'ReembolsoController@solicitacoes']);
            Route::get('create', ['as' => 'reembolso.create', 'uses' => 'ReembolsoController@create']);
            Route::post('store', ['as' => 'reembolso.store', 'uses' => 'ReembolsoController@store']);
            Route::get('edit/{id}', ['as' => 'reembolso.edit', 'uses' => 'ReembolsoController@edit']);
            Route::put('update/{id}', ['as' => 'reembolso.update', 'uses' => 'ReembolsoController@update']);
            Route::get('destroy/{id}', ['as' => 'reembolso.destroy', 'uses' => 'ReembolsoController@destroy']);
        });

        Route::group(['prefix' => 'pagar-conta', 'namespace' => 'PagarConta'], function() {
            Route::get('', ['as' => 'pagar-conta.index', 'uses' => 'PagarContaController@index']);
            Route::get('create', ['as' => 'pagar-conta.create', 'uses' => 'PagarContaController@create']);
            Route::post('store', ['as' => 'pagar-conta.store', 'uses' => 'PagarContaController@store']);
            Route::get('edit/{id}', ['as' => 'pagar-conta.edit', 'uses' => 'PagarContaController@edit']);
            Route::put('update/{id}', ['as' => 'pagar-conta.update', 'uses' => 'PagarContaController@update']);
            Route::get('destroy/{id}', ['as' => 'pagar-conta.destroy', 'uses' => 'PagarContaController@destroy']);
            Route::get('destroyConta/{id}/{id_conta}', ['as' => 'pagar-conta.destroyConta', 'uses' => 'PagarContaController@destroyConta']);
            Route::get('processar/{id}', ['as' => 'pagar-conta.processar', 'uses' => 'PagarContaController@processar']);
        });

    });



    Route::group(['middleware' => 'App\Http\Middleware\UserColaborador'], function () {
        Route::get('/logout', 'Auth\LoginController@logout');
        //ROTAS GERAIS
    });

});
