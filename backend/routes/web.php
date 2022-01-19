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

//ativos
$router->get('/ativos', 'Ativo@listar');
$router->get('/ativos/{id}','Ativo@buscarId');
$router->post('/ativos','Ativo@salvar' );
$router->put('/ativos', 'Ativo@alterar');
$router->delete('/ativos/{id}', 'Ativo@deletar');

//aportes
$router->get('/aportes', 'Aporte@listar');
$router->get('/aportes/{id}','Aporte@buscarId');
$router->post('/aportes','Aporte@salvar' );
$router->put('/aportes', 'Aporte@alterar');
$router->delete('/aportes/{id}', 'Aporte@deletar');
