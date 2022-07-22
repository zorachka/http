<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Webmozart\Assert\Assert;

final class GlobalMiddlewareConfig
{
    /**
     * @var class-string<MiddlewareInterface>[]
     */
    private array $middlewares;

    /**
     * @param class-string<MiddlewareInterface>[] $middlewares
     */
    private function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @param class-string<MiddlewareInterface>[] $middlewares
     * @return $this
     */
    public static function withDefaults(array $middlewares = []): self
    {
        return new self($middlewares);
    }

    /**
     * @param class-string<MiddlewareInterface> $middlewareClassName
     * @return $this
     */
    public function withMiddleware(string $middlewareClassName): self
    {
        Assert::notEmpty($middlewareClassName);

        $new = clone $this;
        $new->middlewares[] = $middlewareClassName;

        return $new;
    }

    /**
     * @return class-string<MiddlewareInterface>[]
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
