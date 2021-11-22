<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Webmozart\Assert\Assert;

final class RouteGroup implements RouteGroupInterface
{
    private string $prefix;
    /**
     * @var RouteInterface[]
     */
    private array $routes;

    /**
     * @param string $prefix
     * @param RouteInterface[] $routes
     */
    private function __construct(string $prefix, array $routes)
    {
        Assert::notEmpty($prefix);
        Assert::notEmpty($routes);
        Assert::allIsInstanceOf($routes, RouteInterface::class);

        $this->prefix = $prefix;
        $this->routes = $routes;
    }

    /**
     * @inheritDoc
     */
    public static function with(string $prefix, array $routes): self
    {
        return new self($prefix, $routes);
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
    public function routes(): array
    {
        return $this->routes;
    }
}
