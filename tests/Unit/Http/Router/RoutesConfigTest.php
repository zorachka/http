<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Router\HttpRoute;
use Zorachka\Framework\Http\Router\HttpRouteGroup;
use Zorachka\Framework\Http\Router\RoutesConfig;

test('RoutesConfig should can be created with defaults', function () {
    $defaultConfig = RoutesConfig::withDefaults();

    expect($defaultConfig->routes())->toBeArray();
    expect($defaultConfig->routes())->toBeEmpty();
});

test('RoutesConfig should can be able to add route', function () {
    $defaultConfig = RoutesConfig::withDefaults();

    $route = mock(HttpRoute::class)->expect();
    $newConfig = $defaultConfig->withRoute($route);

    expect($newConfig->routes())->toMatchArray([
        $route,
    ]);
});

test('RoutesConfig should can be able to add route group', function () {
    $defaultConfig = RoutesConfig::withDefaults();

    $route = mock(HttpRoute::class)
        ->shouldReceive('path')
        ->andReturn('/path')
        ->getMock()
        ->shouldReceive('withPath')
        ->getMock();
    $routeGroup = mock(HttpRouteGroup::class)
        ->shouldReceive('prefix')
        ->andReturn('/prefix')
        ->getMock()
        ->shouldReceive('callback')
        ->andReturn(function (RoutesConfig $config) use ($route) {
            return $config->withRoute($route);
        })
        ->getMock();
    $newConfig = $defaultConfig->withGroup($routeGroup);

    expect($newConfig->routes())->toMatchArray([
        $route->withPath('/prefix/path'),
    ]);
});
