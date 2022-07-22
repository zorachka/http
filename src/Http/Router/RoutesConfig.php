<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Psr\Http\Server\MiddlewareInterface;
use Webmozart\Assert\Assert;

final class RoutesConfig
{
    /**
     * @var HttpRoute[]
     */
    private array $routes;

    private function __construct(array $routes)
    {
        Assert::allIsInstanceOf($routes, HttpRoute::class);

        $this->routes = $routes;
    }

    /**
     * @param array $routes
     * @return static
     */
    public static function withDefaults(array $routes = []): self
    {
        return new self($routes);
    }

    /**
     * @param HttpRoute $route
     * @return $this
     */
    public function withRoute(HttpRoute $route): self
    {
        $new = clone $this;
        $new->routes[] = $route;

        return $new;
    }

    /**
     * @param HttpRouteGroup $routeGroup
     * @return $this
     */
    public function withGroup(HttpRouteGroup $routeGroup): self
    {
        $new = clone $this;

        $newConfig = self::withDefaults();
        $newConfig = $routeGroup->callback()($newConfig);
        $routes = $newConfig->routes();

        /** @var HttpRoute $route */
        foreach ($routes as $route) {
            $newPath = $routeGroup->prefix() . $route->path();

            /** @var class-string<MiddlewareInterface> $middlewareClassName */
            foreach ($routeGroup->middlewares() as $middlewareClassName) {
                $route = $route->withMiddleware($middlewareClassName);
            }

            $new = $new->withRoute(
                $route->withPath($newPath)
            );
        }

        return $new;
    }

    /**
     * @return HttpRoute[]
     */
    public function routes(): array
    {
        return $this->routes;
    }
}
