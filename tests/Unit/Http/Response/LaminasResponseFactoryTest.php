<?php

declare(strict_types=1);

use Zorachka\Framework\Http\Response\LaminasResponseFactory;

test('LaminasResponseFactory should create redirect response', function () {
    $response = LaminasResponseFactory::redirect('/');

    expect($response->getHeaderLine('location'))->toBe('/');
    expect($response->getStatusCode())->toBe(302);
    expect($response->getBody()->getContents())->toBeEmpty();
});
test('LaminasResponseFactory should create json response', function () {
    $response = LaminasResponseFactory::json(['key' => 'value']);

    expect($response->getHeaderLine('Content-type'))->toBe('application/json');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getBody()->getContents())->toBe('{"key":"value"}');
});
test('LaminasResponseFactory should create empty response', function () {
    $response = LaminasResponseFactory::empty();

    expect($response->getStatusCode())->toBe(204);
    expect($response->getBody()->getContents())->toBeEmpty();
});
test('LaminasResponseFactory should create html response', function () {
    $response = LaminasResponseFactory::html('<p>Some text</p>');

    expect($response->getStatusCode())->toBe(200);
    expect($response->getBody()->getContents())->toBe('<p>Some text</p>');
});
