<?php

namespace Trendyol\ApiBundle\Client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Client
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class TrendyolClient implements ClientInterface
{
    /**
     * @var string
     */
    private $sellerId;

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
    private $integrator;


    /**
     * @param $sellerId
     * @param $appKey
     * @param $appSecret
     * @param $integrator
     */
    public function __construct($sellerId, $appKey, $appSecret, $integrator)
    {
        $this->sellerId = $sellerId;
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->integrator = $integrator;
    }

    /**
     * @param $requestUrl
     * @param string $methodType
     * @param array $bodyParam
     * @param array $queryParam
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function request($requestUrl, $methodType = Request::METHOD_GET, $bodyParam = [], $queryParam = []): ResponseInterface
    {
        $options =  $this->getOptions();
        if (!empty($bodyParam)) {
            $options['json'] = $bodyParam;
        }

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
     */
    private function getOptions(): array
    {
        return [
            'headers' => [
                'User-Agent' => $this->getSellerId() . '-' . $this->getIntegrator(),
            ],
            'auth_basic' => [
                $this->getAppKey(),
                $this->getAppSecret(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    /**
     * @param string $sellerId
     */
    public function setSellerId(string $sellerId): void
    {
        $this->sellerId = $sellerId;
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
}