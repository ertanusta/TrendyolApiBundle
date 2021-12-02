<?php

namespace Trendyol\ApiBundle\Client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * Client
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class TrendyolClient implements ClientInterface
{
    /**
     * @var string
     */
    private $supplierId;

    /**
     * @var string
     */
    private $appKey;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var string
     */
    private $integrator = "SelfIntegration";

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $env;

    /**
     * @param $supplierId
     * @param $appKey
     * @param $appSecret
     * @param $integrator
     * @param $url
     * @param $env
     */
    public function __construct($supplierId, $appKey, $appSecret, $integrator, $url, $env)
    {
        $this->supplierId = $supplierId;
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->integrator = $integrator;
        $this->env = $env;
        $this->url = $url;
    }

    /**
     * @param $endPoint
     * @param string $methodType
     * @param array $bodyParam
     * @param array $queryParam
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
     */
    public function request($endPoint, $methodType = Request::METHOD_GET, $bodyParam = [], $queryParam = []): ResponseInterface
    {
        $options = [
            $this->getOptions(),
        ];
        if (!empty($bodyParam)) {
            $options['json'] = $bodyParam;
        }

        $requestUrl = $this->prepareRequestUrl($endPoint);
        if (!empty($queryParam)) {
            $requestUrl .= '?' . http_build_query($queryParam);
        }
        return HttpClient::create()->request(
            $methodType,
            $requestUrl,
            $options
        );
    }

    /**
     * @return array
     * @throws HeaderNotFoundException
     */
    private function getOptions(): array
    {
        if ($this->getSupplierId() === null || $this->getAppSecret() === null || $this->getAppKey() === null) {
            throw new HeaderNotFoundException();
        }
        return [
            'headers' => [
                'User-Agent' => $this->getSupplierId() . '-' . $this->getIntegrator(),
            ],
            'auth_basic' => [
                $this->getAppKey(),
                $this->getAppSecret(),
            ],
        ];
    }

    /**
     * @param $endPoint
     * @return array|string|string[]
     */
    private function prepareRequestUrl($endPoint)
    {
        $requestUrl = $this->url . $endPoint;
        $requestUrl = str_replace('{sellerid}', $this->getSupplierId(), $requestUrl);
        if ($this->env !== "prod") {
            $requestUrl = str_replace('sapigw', 'stagesapigw', $this->url);
        }
        return $requestUrl;
    }

    /**
     * @return string
     */
    public function getSupplierId(): string
    {
        return $this->supplierId;
    }

    /**
     * @param string $supplierId
     */
    public function setSupplierId(string $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     */
    public function setAppKey(string $appKey): void
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret(string $appSecret): void
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getIntegrator(): string
    {
        return $this->integrator;
    }

    /**
     * @param string $integrator
     */
    public function setIntegrator(string $integrator): void
    {
        $this->integrator = $integrator;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}