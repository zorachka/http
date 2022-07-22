<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Router;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

final class Route implements HttpRoute
{
    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const PATCH = 'PATCH';
    private const DELETE = 'DELETE';
    private const HEAD = 'HEAD';

    private string $httpMethod;
    private string $path;
    /**
     * @var class-string<RequestHandlerInterface>
     */
    private string $handler;
    /**
     * @var class-string<MiddlewareInterface>[]
     */
    private array $middlewares = [];

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
            self::HEAD,
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
    public static function get(string $path, string $handler): self
    {
        return new self(self::GET, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function post(string $path, string $handler): self
    {
        return new self(self::POST, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function put(string $path, string $handler): self
    {
        return new self(self::PUT, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function patch(string $path, string $handler): self
    {
        return new self(self::PATCH, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function delete(string $path, string $handler): self
    {
        return new self(self::DELETE, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public static function head(string $path, string $handler): self
    {
        return new self(self::HEAD, $path, $handler);
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
    public function withPath(string $path): HttpRoute
    {
        Assert::notEmpty($path);

        $new = clone $this;
        $new->path = $path;

        return $new;
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

    /**
     * @inheritDoc
     */
    public function withMiddleware(string $middlewareClassName): self
    {
        Assert::notEmpty($middlewareClassName);

        $new = clone $this;
        $new->middlewares[] = $middlewareClassName;

        return $new;
    }

    /**
     * @inheritDoc
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
