<?php

declare(strict_types=1);

namespace Zorachka\Http;

use Psr\Http\Server\RequestHandlerInterface;

interface Application extends RequestHandlerInterface
{
    /**
     * Run application.
     */
    public function run(): void;
}
