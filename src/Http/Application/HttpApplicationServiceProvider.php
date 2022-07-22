<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Application;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Router;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Zorachka\Framework\Container\ServiceProvider;
use Zorachka\Framework\Http\Emitter\Emitter;
use Zorachka\Framework\Http\Emitter\NarrowsparkEmitter;
use Zorachka\Framework\Http\Middleware\GlobalMiddlewareConfig;
use Zorachka\Framework\Http\Response\LaminasResponseFactory;
use Zorachka\Framework\Http\Response\ResponseFactory;
use Zorachka\Framework\Http\Router\RoutesConfig;

final class HttpApplicationServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            ServerRequestFactoryInterface::class => fn() => new ServerRequestFactory(),
            Emitter::class => fn() => new NarrowsparkEmitter(new SapiEmitter),
            ResponseFactory::class => fn() => new LaminasResponseFactory(),
            Application::class => static function(ContainerInterface $container) {
                $router = new Router();

                /** @var GlobalMiddlewareConfig $middlewaresProvider */
                $middlewaresProvider = $container->get(GlobalMiddlewareConfig::class);

                foreach ($middlewaresProvider->middlewares() as $middlewareClassName) {
                    $middleware = $container->get($middlewareClassName);
                    $router->middleware($middleware);
                }

                /** @var RoutesConfig $routesConfig */
                $routesConfig = $container->get(RoutesConfig::class);

                foreach ($routesConfig->routes() as $route) {
                    $routeMiddlewares = \array_map(function (string $middlewareClassName) use ($container) {
                        return $container->get($middlewareClassName);
                    }, $route->middlewares());

                    $router
                        ->map($route->httpMethod(), $route->path(), [$container->get($route->handler()), 'handle'])
                        ->setName($route->name())
                        ->middlewares($routeMiddlewares);
                }

                $middlewareQueue = [
                    $router,
                    new RequestHandler($container),
                ];

                $requestHandler = new Relay($middlewareQueue);
                $serverRequestFactory = $container->get(ServerRequestFactoryInterface::class);
                $emitter = $container->get(Emitter::class);

                return new HttpApplication(
                    $requestHandler,
                    $serverRequestFactory,
                    $emitter,
                );
            },
            GlobalMiddlewareConfig::class => fn() => GlobalMiddlewareConfig::withDefaults(),
            RoutesConfig::class => fn() => RoutesConfig::withDefaults(),
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
