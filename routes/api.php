<?php

use app\Http\Controllers\Api\V1\Auth\LoginController;
use app\Http\Controllers\Api\V1\Auth\LogoutController;
use app\Http\Controllers\Api\V1\Auth\RegisterController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (Router $router) {
    $router->post('login', LoginController::class);
    $router->post('register', RegisterController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (Router $router) {
    $router->post('logout', LogoutController::class);
});
