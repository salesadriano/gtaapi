<?php

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
    return redirect('docs');;
});

$router->post('login', 'AuthController@login');

//Entidade
$router->get('entidade', 'EntidadeController@mostrar');

//Estabelecimento
$router->get('estabelecimento', 'EstabelecimentoController@mostrar');

//GTA
$router->get('gta', 'GtaController@mostrar');



