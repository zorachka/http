<?php

declare(strict_types=1);

use Psr\Http\Server\RequestHandlerInterface;
use Zorachka\Framework\Http\Router\Route;

test('Route::get should throw exception if path is empty', function () {
    Route::get('', RequestHandlerInterface::class);
})->throws(InvalidArgumentException::class);
test('Route::post should throw exception if path is empty', function () {
    Route::post('', RequestHandlerInterface::class);
})->throws(InvalidArgumentException::class);
test('Route::put should throw exception if path is empty', function () {
    Route::put('', RequestHandlerInterface::class);
})->throws(InvalidArgumentException::class);
test('Route::patch should throw exception if path is empty', function () {
    Route::patch('', RequestHandlerInterface::class);
})->throws(InvalidArgumentException::class);
test('Route::delete should throw exception if path is empty', function () {
    Route::delete('', RequestHandlerInterface::class);
})->throws(InvalidArgumentException::class);

test('Route::get should throw exception if handler is not RequestHandlerInterface::class', function () {
    Route::get('', stdClass::class);
})->throws(InvalidArgumentException::class);
test('Route::post should throw exception if handler is not RequestHandlerInterface::class', function () {
    Route::post('', stdClass::class);
})->throws(InvalidArgumentException::class);
test('Route::put should throw exception if handler is not RequestHandlerInterface::class', function () {
    Route::put('', stdClass::class);
})->throws(InvalidArgumentException::class);
test('Route::patch should throw exception if handler is not RequestHandlerInterface::class', function () {
    Route::patch('', stdClass::class);
})->throws(InvalidArgumentException::class);
test('Route::delete should throw exception if handler is not RequestHandlerInterface::class', function () {
    Route::delete('', stdClass::class);
})->throws(InvalidArgumentException::class);

test('Route::get should can be created with path and handler', function () {
    $route = Route::get('/route', RequestHandlerInterface::class);

    expect($route->httpMethod())->toBe('GET');
    expect($route->path())->toBe('/route');
    expect($route->handler())->toBe(RequestHandlerInterface::class);
});
test('Route::post should can be created with path and handler', function () {
    $route = Route::post('/route', RequestHandlerInterface::class);

    expect($route->httpMethod())->toBe('POST');
    expect($route->path())->toBe('/route');
    expect($route->handler())->toBe(RequestHandlerInterface::class);
});
test('Route::put should can be created with path and handler', function () {
    $route = Route::put('/route', RequestHandlerInterface::class);

    expect($route->httpMethod())->toBe('PUT');
    expect($route->path())->toBe('/route');
    expect($route->handler())->toBe(RequestHandlerInterface::class);
});
test('Route::patch should can be created with path and handler', function () {
    $route = Route::patch('/route', RequestHandlerInterface::class);

    expect($route->httpMethod())->toBe('PATCH');
    expect($route->path())->toBe('/route');
    expect($route->handler())->toBe(RequestHandlerInterface::class);
});
test('Route::delete should can be created with path and handler', function () {
    $route = Route::delete('/route', RequestHandlerInterface::class);

    expect($route->httpMethod())->toBe('DELETE');
    expect($route->path())->toBe('/route');
    expect($route->handler())->toBe(RequestHandlerInterface::class);
});
