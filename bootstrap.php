<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zorachka\Container\ContainerFactory;
use Zorachka\Container\ServiceProvider;
use Zorachka\Http\Providers\HttpServiceProvider;
use Zorachka\Http\Response\ResponseFactory;
use Zorachka\Http\Router\Route;
use Zorachka\Http\Router\RouterConfig;

mb_internal_encoding('UTF-8');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'stderr');

$rootDirectory = __DIR__;
define('ROOT', $rootDirectory);

require_once $rootDirectory . '/vendor/autoload.php';

final class HomePageAction implements RequestHandlerInterface
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->responseFactory::html('<h1>Hello, world!</h1>');
    }
}

final class ApplicationServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function getExtensions(): array
    {
        return [
            RouterConfig::class => static function (RouterConfig $config) {
                return $config->withRoute(
                    Route::get('/', HomePageAction::class)
                        ->withName('home')
                );
            },
        ];
    }
}

return static function (): ContainerInterface {
    return (new ContainerFactory())->build([
            HttpServiceProvider::class,
            ApplicationServiceProvider::class,
        ]
    );
};
