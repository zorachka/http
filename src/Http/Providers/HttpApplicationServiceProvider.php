<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Providers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;

use FastRoute\RouteCollector;
use Zorachka\Framework\Http\Application;
use Zorachka\Framework\Http\HttpApplication;
use Zorachka\Framework\Http\Middleware\MiddlewaresServiceProvider;
use Zorachka\Framework\Http\Router\RouterConfig;
use function FastRoute\simpleDispatcher;

use Middlewares\FastRoute;
use Middlewares\RequestHandler;

use Zorachka\Framework\Http\Emitter\Emitter;
use Zorachka\Framework\Container\ServiceProvider;

use Relay\Relay;

final class HttpApplicationServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            Application::class => static function(ContainerInterface $container) {
                $routes = simpleDispatcher(function (RouteCollector $collector) use ($container) {
                    /** @var RouterConfig $routerConfig */
                    $routerConfig = $container->get(RouterConfig::class);
                    $routes = $routerConfig->routes();

                    foreach ($routes as $route) {
                        $collector->addRoute(
                            $route->httpMethod(),
                            $route->path(),
                            $route->handler(),
                        );
                    }

                    $groups = $routerConfig->groups();
                    foreach ($groups as $group) {
                        $prefix = $group->prefix();
                        $routes = $group->routes();

                        $collector->addGroup(
                            $prefix,
                            function (RouteCollector $collector) use ($routes) {
                                foreach ($routes as $route) {
                                    $collector->addRoute(
                                        $route->httpMethod(),
                                        $route->path(),
                                        $route->handler(),
                                    );
                                }
                            }
                        );
                    }
                });

                /** @var MiddlewaresServiceProvider $middlewaresProvider */
                $middlewaresProvider = $container->get(MiddlewaresServiceProvider::class);

                $middlewareQueue = [];

                $baseMiddlewareQueue = [
                    new FastRoute($routes),
                    new RequestHandler($container),
                ];

                foreach ($middlewaresProvider->getMiddlewares() as $middlewareClassName) {
                    $middleware = $container->get($middlewareClassName);
                    $middlewareQueue[] = $middleware;
                }

                foreach ($baseMiddlewareQueue as $middleware) {
                    $middlewareQueue[] = $middleware;
                }

                $requestHandler = new Relay($middlewareQueue);
                $serverRequestFactory = $container->get(ServerRequestFactoryInterface::class);
                $emitter = $container->get(Emitter::class);

                return new HttpApplication(
                    $requestHandler,
                    $serverRequestFactory,
                    $emitter,
                );
            },
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
