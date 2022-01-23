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

$router->get('/',function(){
    echo json_encode(['msg'=>'Api Rest para controle de investimetos...']);
});

//ativos
$router->get('/ativos', ['middleware'=>'auth','uses'=>'Ativo@listar']);
$router->get('/ativos/{id}', ['middleware'=>'auth','uses'=>'Ativo@buscarId']);
$router->post('/ativos',['middleware'=>'auth','uses'=>'Ativo@salvar']);
$router->put('/ativos', ['middleware'=>'auth','uses'=>'Ativo@alterar']);
$router->delete('/ativos/{id}', ['middleware'=>'auth','uses'=>'Ativo@deletar']);

//aportes
$router->get('/aportes', ['middleware'=>'auth','uses'=>'Aporte@listar']);
$router->get('/aportes/{id}',['middleware'=>'auth','uses'=>'Aporte@buscarId']);
$router->post('/aportes',['middleware'=>'auth','uses'=>'Aporte@salvar']);
$router->put('/aportes', ['middleware'=>'auth','uses'=>'Aporte@alterar']);
$router->delete('/aportes/{id}', ['middleware'=>'auth','uses'=>'Aporte@deletar']);

//proventos
$router->get('/proventos', ['middleware'=>'auth','uses'=>'Provento@listar']);
$router->get('/proventos/{id}',['middleware'=>'auth','uses'=>'Provento@buscarId']);
$router->post('/proventos',['middleware'=>'auth','uses'=>'Provento@salvar']);
$router->put('/proventos', ['middleware'=>'auth','uses'=>'Provento@alterar']);
$router->delete('/proventos/{id}', ['middleware'=>'auth','uses'=>'Provento@deletar']);

//informe
$router->get('/informe', ['middleware'=>'auth','uses'=>'Informe@listar']);
$router->get('/informe/{id}',['middleware'=>'auth','uses'=>'Informe@buscarId']);
$router->post('/informe',['middleware'=>'auth','uses'=>'Informe@salvar']);
$router->put('/informe', ['middleware'=>'auth','uses'=>'Informe@alterar']);
$router->delete('/informe/{id}', ['middleware'=>'auth','uses'=>'Informe@deletar']);

//lancamentos
$router->get('/lancamentos', ['middleware'=>'auth','uses'=>'Lancamento@listar']);
$router->get('/lancamentos/{id}',['middleware'=>'auth','uses'=>'Lancamento@buscarId']);
$router->post('/lancamentos',['middleware'=>'auth','uses'=>'Lancamento@salvar']);
$router->put('/lancamentos', ['middleware'=>'auth','uses'=>'Lancamento@alterar']);
$router->delete('/lancamentos/{id}', ['middleware'=>'auth','uses'=>'Lancamento@deletar']);

//resgates
$router->get('/resgates', ['middleware'=>'auth','uses'=>'Resgate@listar']);
$router->get('/resgates/{id}',['middleware'=>'auth','uses'=>'Resgate@buscarId']);
$router->post('/resgates',['middleware'=>'auth','uses'=>'Resgate@salvar']);
$router->delete('/resgates/{id}', ['middleware'=>'auth','uses'=>'Resgate@deletar']);

//usuario
$router->get('/autenticar/{user}/{pass}','Usuario@autenticar');