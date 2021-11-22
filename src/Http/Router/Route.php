<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use InvalidArgumentException;
use Psr\Http\Server\RequestHandlerInterface;
use Webmozart\Assert\Assert;

final class Route implements RouteInterface
{
    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const PATCH = 'PATCH';
    private const DELETE = 'DELETE';

    private string $httpMethod;
    private string $path;
    private string $handler;

    /**
     * @param string $httpMethod
     * @param string $path
     * @param class-string<RequestHandlerInterface> $handler
     */
    private function __construct(string $httpMethod, string $path, string $handler)
    {
        Assert::notEmpty($httpMethod);
        Assert::inArray($httpMethod, [
            self::GET,
            self::POST,
            self::PUT,
            self::PATCH,
            self::DELETE,
        ]);
        Assert::notEmpty($path);
        Assert::notEmpty($handler);
        if (!is_a($handler, RequestHandlerInterface::class, true)) {
            throw new InvalidArgumentException(sprintf(
                'Class "%s" was expected to implement "%s"',
                $handler,
                RequestHandlerInterface::class
            ));
        }
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @inheritDoc
     */
    public static function get(string $route, string $handler): self
    {
        return new self(self::GET, $route, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function post(string $route, string $handler): self
    {
        return new self(self::POST, $route, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function put(string $route, string $handler): self
    {
        return new self(self::PUT, $route, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function patch(string $route, string $handler): self
    {
        return new self(self::PATCH, $route, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function delete(string $route, string $handler): self
    {
        return new self(self::DELETE, $route, $handler);
    }

    /**
     * @inheritDoc
     */
    public function httpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function handler(): string
    {
        return $this->handler;
    }
}
