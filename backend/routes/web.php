<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*Route::get('/caixa','Caixa@index')->middleware(['IsOk']);
Route::post('/caixa-salvar','Caixa@salvar')->middleware(['IsOk']);
Route::get('/caixa-deletar/{id}','Caixa@deletar')->middleware(['IsOk']);
Route::post('/caixa-pesquisar','Caixa@pesquisar')->middleware(['IsOk']);
Route::get('/caixa-pesquisar','Caixa@index')->middleware(['IsOk']);*/

$router->get('/ativos', 'Ativo@listar');


