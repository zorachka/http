<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Application;
use Zorachka\Framework\Http\Providers\HttpApplicationServiceProvider;

test('HttpApplicationServiceProvider should contain definitions', function () {
    expect(
        array_keys(HttpApplicationServiceProvider::getDefinitions())
    )->toMatchArray([
        Application::class,
    ]);
});
