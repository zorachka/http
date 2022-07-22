<?php

declare(strict_types=1);

use Psr\Http\Server\MiddlewareInterface;
use Zorachka\Framework\Http\Router\Route;
use Zorachka\Framework\Http\Router\RouteGroup;
use Zorachka\Framework\Http\Router\RoutesConfig;

test('RouteGroup should throw exception if prefix is empty', function () {
    RouteGroup::withPrefix('', function (RoutesConfig $config) {});
})->throws(InvalidArgumentException::class);

test('RouteGroup should can be created with prefix', function () {
    $group = RouteGroup::withPrefix('/prefix', function (RoutesConfig $config) {
        return $config->withRoute(mock(Route::class));
    });

    expect($group->prefix())->toBe('/prefix');
});

test('RouteGroup should can be created with middleware', function () {
    $group = RouteGroup::withPrefix('/prefix', function (RoutesConfig $config) {
        return $config->withRoute(mock(Route::class));
    })->withMiddleware(MiddlewareInterface::class);

    expect($group->middlewares())->toMatchArray([MiddlewareInterface::class]);
});
