<?php

declare(strict_types=1);

use Psr\Http\Server\MiddlewareInterface;
use Zorachka\Framework\Http\Middleware\GlobalMiddlewareConfig;

test('GlobalMiddlewareConfig should can be created with defaults', function () {
    $defaultConfig = GlobalMiddlewareConfig::withDefaults();

    expect($defaultConfig->middlewares())->toBeArray();
    expect($defaultConfig->middlewares())->toBeEmpty();
});

test('GlobalMiddlewareConfig should can be able to add middleware', function () {
    $defaultConfig = GlobalMiddlewareConfig::withDefaults();

    $middleware = MiddlewareInterface::class;
    $newConfig = $defaultConfig->withMiddleware($middleware);

    expect($newConfig->middlewares())->toMatchArray([
        $middleware,
    ]);
});
