<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestFactoryInterface;
use Zorachka\Framework\Http\Application\Application;
use Zorachka\Framework\Http\Application\HttpApplicationServiceProvider;
use Zorachka\Framework\Http\Emitter\Emitter;
use Zorachka\Framework\Http\Middleware\GlobalMiddlewareConfig;
use Zorachka\Framework\Http\Response\ResponseFactory;
use Zorachka\Framework\Http\Router\RoutesConfig;

test('HttpApplicationServiceProvider should contain definitions', function () {
    expect(
        array_keys(HttpApplicationServiceProvider::getDefinitions())
    )->toMatchArray([
        ServerRequestFactoryInterface::class,
        Emitter::class,
        ResponseFactory::class,
        Application::class,
        GlobalMiddlewareConfig::class,
        RoutesConfig::class,
    ]);
});
