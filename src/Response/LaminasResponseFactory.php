<?php

declare(strict_types=1);

namespace Zorachka\Http\Response;

use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;

final class LaminasResponseFactory implements ResponseFactory
{
    /**
     * @param array<string, string> $headers
     */
    public static function redirect($uri, int $status = 302, array $headers = []): ResponseInterface
    {
        return new RedirectResponse($uri, $status, $headers);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function json(
        $data,
        int $status = 200,
        array $headers = [],
        int $encodingOptions = self::DEFAULT_JSON_FLAGS
    ): ResponseInterface {
        return new JsonResponse($data, $status, $headers, $encodingOptions);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function empty(int $status = 204, array $headers = []): ResponseInterface
    {
        return new EmptyResponse($status, $headers);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function html($html, int $status = 200, array $headers = []): ResponseInterface
    {
        return new HtmlResponse($html, $status, $headers);
    }
}
