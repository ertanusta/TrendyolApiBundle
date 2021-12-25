<?php

namespace Trendyol\ApiBundle\Client;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * ClientInterface
 * @author Ertan USTA <ertanusta@outlook.com>
 */
interface ClientInterface
{
    public function request($requestUrl, $methodType = Request::METHOD_GET, $bodyParam = [], $queryParam = []): ResponseInterface;

    public function getSellerId():string;

    public function setSellerId(string $sellerId);

    public function setAppKey(string $appKey);

    public function setAppSecret(string $appSecret);

    public function setIntegrator(string $integrator);
}