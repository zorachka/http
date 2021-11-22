<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Router\RouteGroup;
use Zorachka\Framework\Http\Router\RouteInterface;

test('RouteGroup should throw exception if prefix is empty', function () {
    RouteGroup::with('', [
        mock(RouteInterface::class),
    ]);
})->throws(InvalidArgumentException::class);

test('RouteGroup should throw exception if routes is empty', function () {
    RouteGroup::with('/prefix', [
    ]);
})->throws(InvalidArgumentException::class);

test('RouteGroup should throw exception if routes is not instance of Route', function () {
    RouteGroup::with('/prefix', [
        mock(RouteInterface::class),
        mock(stdClass::class),
    ]);
})->throws(InvalidArgumentException::class);

test('RouteGroup should can be created with prefix and routes', function () {
    $routes = [
        mock(RouteInterface::class),
    ];
    $group = RouteGroup::with('prefix', $routes);

    expect($group->prefix())->toBe('prefix');
    expect($group->routes())->toBe($routes);
})->throws(InvalidArgumentException::class);
