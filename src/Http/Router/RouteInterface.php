<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RouteInterface
{
    /**
     * @param string $route
     * @param class-string<RequestHandlerInterface> $handler
     * @return Route
     */
    public static function get(string $route, string $handler): self;

    /**
     * @param string $route
     * @param class-string<RequestHandlerInterface> $handler
     * @return Route
     */
    public static function post(string $route, string $handler): self;

    /**
     * @param string $route
     * @param class-string<RequestHandlerInterface> $handler
     * @return Route
     */
    public static function put(string $route, string $handler): self;

    /**
     * @param string $route
     * @param class-string<RequestHandlerInterface> $handler
     * @return Route
     */
    public static function patch(string $route, string $handler): self;

    /**
     * @param string $route
     * @param class-string<RequestHandlerInterface> $handler
     * @return Route
     */
    public static function delete(string $route, string $handler): self;

    /**
     * @return string
     */
    public function httpMethod(): string;

    /**
     * @return string
     */
    public function path(): string;

    /**
     * @return class-string
     */
    public function handler(): string;
}
