<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Providers;

use Laminas\Diactoros\ServerRequestFactory;
use Narrowspark\HttpEmitter\SapiEmitter;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Zorachka\Framework\Http\Emitter\Emitter;
use Zorachka\Framework\Http\Emitter\NarrowsparkEmitter;
use Zorachka\Container\ServiceProvider;
use Zorachka\Framework\Http\Response\LaminasResponseFactory;
use Zorachka\Framework\Http\Response\ResponseFactory;

final class HttpServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            ServerRequestFactoryInterface::class => static fn() => new ServerRequestFactory,
            Emitter::class => static fn() => new NarrowsparkEmitter(new SapiEmitter),
            ResponseFactory::class => static fn() => new LaminasResponseFactory,
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
