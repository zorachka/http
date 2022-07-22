<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface HttpRoute
{
    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function get(string $path, string $handler): self;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function post(string $path, string $handler): self;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function put(string $path, string $handler): self;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function patch(string $path, string $handler): self;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function delete(string $path, string $handler): self;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     * @return static
     */
    public static function head(string $path, string $handler): self;

    /**
     * @return string
     */
    public function httpMethod(): string;

    /**
     * @return self
     */
    public function withPath(string $path): self;

    /**
     * @return string
     */
    public function path(): string;

    /**
     * @return class-string
     */
    public function handler(): string;

    /**
     * @param class-string<MiddlewareInterface> $middlewareClassName
     * @return self
     */
    public function withMiddleware(string $middlewareClassName): self;

    /**
     * @return class-string<MiddlewareInterface>[]
     */
    public function middlewares(): array;
}
