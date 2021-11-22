<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Webmozart\Assert\Assert;

final class RouteGroup
{
    private string $prefix;
    /**
     * @var Route[]
     */
    private array $routes;

    /**
     * @param string $prefix
     * @param Route[] $routes
     */
    private function __construct(string $prefix, array $routes)
    {
        Assert::notEmpty($prefix);
        Assert::allIsInstanceOf($routes, Route::class);

        $this->prefix = $prefix;
        $this->routes = $routes;
    }

    public static function with(string $prefix, array $routes): self
    {
        return new self($prefix, $routes);
    }

    /**
     * @return string
     */
    public function prefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return Route[]
     */
    public function routes(): array
    {
        return $this->routes;
    }
}
