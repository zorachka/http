<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Webmozart\Assert\Assert;
use Psr\Http\Server\MiddlewareInterface;

final class RouteGroup implements HttpRouteGroup
{
    private string $prefix;
    /**
     * @var callable
     */
    private $callback;
    /**
     * @var class-string<MiddlewareInterface>[]
     */
    private array $middlewares;

    /**
     * @param string $prefix
     * @param callable $callback
     */
    private function __construct(string $prefix, callable $callback)
    {
        Assert::notEmpty($prefix);

        $this->prefix = $prefix;
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public static function withPrefix(string $prefix, callable $callback): self
    {
        return new self($prefix, $callback);
    }

    /**
     * @inheritDoc
     */
    public function prefix(): string
    {
        return $this->prefix;
    }

    /**
     * @inheritDoc
     */
    public function callback(): callable
    {
        return $this->callback;
    }

    /**
     * @inheritDoc
     */
    public function withMiddleware(string $middlewareClassName): self
    {
        Assert::notEmpty($middlewareClassName);

        $new = clone $this;
        $new->middlewares[] = $middlewareClassName;

        return $new;
    }

    /**
     * @inheritDoc
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
