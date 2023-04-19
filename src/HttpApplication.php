<?php

declare(strict_types=1);

namespace Zorachka\Http;

use Mezzio\Application as MezzioApplication;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HttpApplication implements Application
{
    private MezzioApplication $application;

    public function __construct(MezzioApplication $application)
    {
        $this->application = $application;
    }

    public function run(): void
    {
        $this->application->run();
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->application->handle($request);
    }
}
