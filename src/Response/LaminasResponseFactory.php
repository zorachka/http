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
    public static function redirect($uri, Status $status = Status::HTTP_FOUND, array $headers = []): ResponseInterface
    {
        return new RedirectResponse($uri, $status->value, $headers);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function json(
        $data,
        Status $status = Status::HTTP_OK,
        array $headers = [],
        int $encodingOptions = self::DEFAULT_JSON_FLAGS
    ): ResponseInterface {
        return new JsonResponse($data, $status->value, $headers, $encodingOptions);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function empty(Status $status = Status::HTTP_NO_CONTENT, array $headers = []): ResponseInterface
    {
        return new EmptyResponse($status->value, $headers);
    }

    /**
     * @param array<string, string> $headers
     */
    public static function html($html, Status $status = Status::HTTP_OK, array $headers = []): ResponseInterface
    {
        return new HtmlResponse($html, $status->value, $headers);
    }
}
