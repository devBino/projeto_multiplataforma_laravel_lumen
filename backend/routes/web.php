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

//proventos
$router->get('/proventos', 'Provento@listar');
$router->get('/proventos/{id}','Provento@buscarId');
$router->post('/proventos','Provento@salvar' );
$router->put('/proventos', 'Provento@alterar');
$router->delete('/proventos/{id}', 'Provento@deletar');

//informe
$router->get('/informe', 'Informe@listar');
$router->get('/informe/{id}','Informe@buscarId');
$router->post('/informe','Informe@salvar' );
$router->put('/informe', 'Informe@alterar');
$router->delete('/informe/{id}', 'Informe@deletar');

//lancamentos
$router->get('/lancamentos', 'Lancamento@listar');
$router->get('/lancamentos/{id}','Lancamento@buscarId');
$router->post('/lancamentos','Lancamento@salvar' );
$router->put('/lancamentos', 'Lancamento@alterar');
$router->delete('/lancamentos/{id}', 'Lancamento@deletar');

//resgates
$router->get('/resgates', 'Resgate@listar');
$router->get('/resgates/{id}','Resgate@buscarId');
$router->post('/resgates','Resgate@salvar' );
$router->delete('/resgates/{id}', 'Resgate@deletar');
