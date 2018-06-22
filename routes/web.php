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

/**
 * @todo come back to add auth. Get with Dakota and Sam to see how to implement their current auth set up.
 */
$router->group(['prefix' => 'recipes'], function () use ($router) {
    $router->get('search/{recipe}', 'RecipeController@search');
    $router->post('/add', 'RecipeController@add');
});


