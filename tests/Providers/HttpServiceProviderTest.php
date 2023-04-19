<?php

declare(strict_types=1);

namespace Zorachka\Http\Tests\Providers;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Helper\UrlHelperMiddleware;
use Mezzio\Middleware\ErrorResponseGenerator;
use Mezzio\Response\ServerRequestErrorResponseGenerator;
use Mezzio\Router\Middleware\ImplicitHeadMiddleware;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\RouteCollectorInterface;
use Mezzio\Router\RouterInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Whoops\RunInterface;
use Zorachka\Http\Application;
use Zorachka\Http\Middleware\MiddlewaresConfig;
use Zorachka\Http\Providers\HttpServiceProvider;
use Zorachka\Http\Router\RouterConfig;
use Zorachka\Http\Whoops\WhoopsConfig;
use Zorachka\Http\Whoops\WhoopsPageHandler;

/**
 * @internal
 */
final class HttpServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldContainDefinitions(): void
    {
        Assert::assertEquals([
            /* Config */
            RouterConfig::class,
            MiddlewaresConfig::class,
            WhoopsConfig::class,
            /* Middlewares */
            ImplicitHeadMiddleware::class,
            ImplicitOptionsMiddleware::class,
            MethodNotAllowedMiddleware::class,
            UrlHelperMiddleware::class,
            NotFoundHandler::class,
            /* Whoops */
            RunInterface::class,
            WhoopsPageHandler::class,

            /* PSR */
            \Zorachka\Http\Response\ResponseFactory::class,
            StreamInterface::class,
            ResponseFactoryInterface::class,

            /* Application */
            ServerRequestErrorResponseGenerator::class,
            ServerRequestFactoryInterface::class,
            RouterInterface::class,
            RouteCollectorInterface::class,
            ErrorResponseGenerator::class,
            ErrorHandler::class,
            Application::class,
        ], array_keys(HttpServiceProvider::getDefinitions()));
    }
}
