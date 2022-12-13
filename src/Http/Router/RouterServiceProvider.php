<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Zorachka\Container\ServiceProvider;

final class RouterServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            RouterConfig::class => static fn() => RouterConfig::withDefaults(),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getExtensions(): array
    {
        return [];
    }
}
