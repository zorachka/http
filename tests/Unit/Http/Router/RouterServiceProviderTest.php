<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Router\RouterConfig;
use Zorachka\Framework\Http\Router\RouterServiceProvider;

test('RouterServiceProvider should contain definitions', function () {
    expect(
        array_keys(RouterServiceProvider::getDefinitions())
    )->toMatchArray([
        RouterConfig::class,
    ]);
});
