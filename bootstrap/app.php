<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();


    // When defininf routes that share the same URI, routes using the get, post, put, patch etc should be defined before routes uing the any
    // This ensure that incoming request is matche with the correct resourcebundle_get_error_code



    // You may type-hint any dependency required by yout route in your route callback function
    // The decalred dependency will automatically be resolved and injected into the callback by the larvel service containe