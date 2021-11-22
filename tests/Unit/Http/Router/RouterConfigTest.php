<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Router\RouteGroupInterface;
use Zorachka\Framework\Http\Router\RouteInterface;
use Zorachka\Framework\Http\Router\RouterConfig;

test('RouterConfig should can be created with defaults', function () {
    $defaultConfig = RouterConfig::withDefaults();

    expect($defaultConfig->routes())->toBeArray();
    expect($defaultConfig->groups())->toBeArray();

    expect($defaultConfig->routes())->toBeEmpty();
    expect($defaultConfig->groups())->toBeEmpty();
});

test('RouterConfig should can be able to add route', function () {
    $defaultConfig = RouterConfig::withDefaults();

    $route = mock(RouteInterface::class)->expect();
    $newConfig = $defaultConfig->addRoute($route);

    expect($newConfig->routes())->toMatchArray([
        $route,
    ]);
});

test('RouterConfig should can be able to add route group', function () {
    $defaultConfig = RouterConfig::withDefaults();

    $routeGroup = mock(RouteGroupInterface::class)->expect();
    $newConfig = $defaultConfig->addGroup($routeGroup);

    expect($newConfig->groups())->toMatchArray([
        $routeGroup,
    ]);
});
