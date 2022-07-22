<?php

declare(strict_types=1);

namespace Zorachka\Framework\Http\Application;

interface Application
{
    /**
     * Run application.
     */
    public function run(): void;
}
