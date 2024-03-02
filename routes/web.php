<?php

/** @var Router $router */

use \App\Http\Controllers\UserController;

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

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'/api/'], function () use ($router){

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->group(['middleware' => 'guest'], function() use ($router){
            $router->post('register', ['uses'=>'User\RegisterController@register']);
            $router->post('login', ['uses'=>'User\AuthController@login']);
        });
        $router->group(['middleware'=>'auth'], function() use($router){
            $router->put('/', ['uses'=>'User\UpdateController@update']);
            $router->delete('/', ['uses'=>'User\DeleteController@delete']);
        });
    });

    //Доступ имеют все авторизованные пользователи
    $router->group(['middleware' => 'auth'], function() use ($router){
        $router->get('user', function () {
            return response()->json(Auth::user());
        });
        $router->post('lottery_game_match_users/{lottery_game_match_id}', ['uses'=>'LotteryGameMatch\AttachController@record']);
    });
    $router->group(['middleware' => ['admin', 'auth']], function() use($router){
        $router->post('lottery_game_matches', ['uses'=>'LotteryGameMatch\CreateController@store']);
        $router->put('lottery_game_matches/{lottery_game_match_id}', ['uses'=>'LotteryGameMatch\UpdateController@update']);
    });
    // Все имеют к ним доступ:
    $router->get('lottery_games', ['uses'=>'LotteryGame\IndexController@index']);
});

