<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Psr\Http\Server\MiddlewareInterface;

interface HttpRouteGroup
{
    /**
     * @param string $prefix
     * @param callable $callback
     * @return static
     */
    public static function withPrefix(string $prefix, callable $callback): self;

    /**
     * @return string
     */
    public function prefix(): string;

    /**
     * @return callable
     */
    public function callback(): callable;

    /**
     * @param class-string $middlewareClassName
     * @return $this
     */
    public function withMiddleware(string $middlewareClassName): self;

    /**
     * @return class-string<MiddlewareInterface>[]
     */
    public function middlewares(): array;
}
