<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestFactoryInterface;
use Zorachka\Framework\Http\Emitter\Emitter;
use Zorachka\Framework\Http\Providers\HttpServiceProvider;
use Zorachka\Framework\Http\Response\ResponseFactory;

test('HttpServiceProvider should contain definitions', function () {
    expect(
        array_keys(HttpServiceProvider::getDefinitions())
    )->toMatchArray([
        ServerRequestFactoryInterface::class,
        Emitter::class,
        ResponseFactory::class,
    ]);
});
