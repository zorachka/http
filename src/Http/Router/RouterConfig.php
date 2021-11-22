<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Webmozart\Assert\Assert;

final class RouterConfig
{
    /**
     * @var Route[]
     */
    private array $routes;
    /**
     * @var RouteGroup[]
     */
    private array $groups;

    private function __construct(array $routes, array $groups)
    {
        Assert::allIsInstanceOf($routes, Route::class);
        Assert::allIsInstanceOf($groups, RouteGroup::class);

        $this->routes = $routes;
        $this->groups = $groups;
    }

    public static function withDefaults(array $routes = [], array $groups = []): self
    {
        return new self($routes, $groups);
    }

    public function addRoute(Route $route): self
    {
        $new = clone $this;
        $new->routes[] = $route;

        return $new;
    }

    public function addGroup(RouteGroup $routeGroup): self
    {
        $new = clone $this;
        $new->groups[] = $routeGroup;

        return $new;
    }

    /**
     * @return Route[]
     */
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @return RouteGroup[]
     */
    public function groups(): array
    {
        return $this->groups;
    }
}
