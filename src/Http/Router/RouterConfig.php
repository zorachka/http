<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Webmozart\Assert\Assert;

final class RouterConfig
{
    /**
     * @var RouteInterface[]
     */
    private array $routes;
    /**
     * @var RouteGroupInterface[]
     */
    private array $groups;

    private function __construct(array $routes, array $groups)
    {
        Assert::allIsInstanceOf($routes, RouteInterface::class);
        Assert::allIsInstanceOf($groups, RouteGroupInterface::class);

        $this->routes = $routes;
        $this->groups = $groups;
    }

    /**
     * @param array $routes
     * @param array $groups
     * @return static
     */
    public static function withDefaults(array $routes = [], array $groups = []): self
    {
        return new self($routes, $groups);
    }

    /**
     * @param RouteInterface $route
     * @return $this
     */
    public function addRoute(RouteInterface $route): self
    {
        $new = clone $this;
        $new->routes[] = $route;

        return $new;
    }

    /**
     * @param RouteGroupInterface $routeGroup
     * @return $this
     */
    public function addGroup(RouteGroupInterface $routeGroup): self
    {
        $new = clone $this;
        $new->groups[] = $routeGroup;

        return $new;
    }

    /**
     * @return RouteInterface[]
     */
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @return RouteGroupInterface[]
     */
    public function groups(): array
    {
        return $this->groups;
    }
}
