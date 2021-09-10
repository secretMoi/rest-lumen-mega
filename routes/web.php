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




$router->group(['prefix' => 'api'], function () use ($router){
    $router->post('/login', 'AuthController@Login');
    $router->post('/register', 'AuthController@Register');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@Logout');

        $router->get('/clients/{id}', 'ClientController@GetClientById');
        $router->get('/clients', 'ClientController@GetAll');
        $router->post('/clients', 'ClientController@SaveNewClient');

        $router->get('/contrats/fromClient/{clientId}', 'ContratController@GetAllContractsFromClient');
        $router->put('/contrats/{id}', 'ContratController@UpdateContract');
    });
});
