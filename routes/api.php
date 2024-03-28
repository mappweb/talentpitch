<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Challenge\CreateChallengeController;
use App\Http\Controllers\Api\V1\Challenge\DestroyChallengeController;
use App\Http\Controllers\Api\V1\Challenge\PaginateChallengeController;
use App\Http\Controllers\Api\V1\Challenge\ShowChallengeController;
use App\Http\Controllers\Api\V1\Challenge\UpdateChallengeController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (Router $router) {
    $router->post('login', LoginController::class);
    $router->post('register', RegisterController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (Router $router) {
    $router->post('logout', LogoutController::class);

    //Challenges
    $router->get('challenges', PaginateChallengeController::class);
    $router->post('challenges', CreateChallengeController::class);
    $router->get('challenges/{challenge}', ShowChallengeController::class);
    $router->put('challenges/{challenge}', UpdateChallengeController::class);
    $router->delete('challenges/{challenge}', DestroyChallengeController::class);
});
