<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Zorachka\Framework\Container\ServiceProvider;

final class RouterServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            RouterConfig::class => fn() => RouterConfig::withDefaults(),
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
