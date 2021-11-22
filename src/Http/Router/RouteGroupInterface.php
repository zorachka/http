<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

interface RouteGroupInterface
{
    /**
     * @param string $prefix
     * @param RouteInterface[] $routes
     * @return static
     */
    public static function with(string $prefix, array $routes): self;

    /**
     * @return string
     */
    public function prefix(): string;

    /**
     * @return RouteInterface[]
     */
    public function routes(): array;
}
