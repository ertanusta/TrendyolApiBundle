<?php

namespace Trendyol\ApiBundle\Factories;


class TrendyolUrlFactory implements UrlFactoryInterface
{
    /**
     * @var string[]
     */
    private $trendyolApiUrl;
    /**
     * @var string
     */
    private $sellerId = "";

    /**
     * @param $urlData
     */
    public function __construct($urlData)
    {
        $this->trendyolApiUrl = $urlData;

    }

    /**
     * @param string $serviceName
     * @param array $arguments
     * @return string
     */
    public function createUrl(string $serviceName, array $arguments = []): string
    {
        $requestUrl = $this->trendyolApiUrl['trendyol_url'][$serviceName];
        foreach ($arguments as $key => $argument) {
            $requestUrl = str_replace($key, $argument, $requestUrl);
        }
        return str_replace('[sellerid]', $this->sellerId, $requestUrl);
    }

    /**
     * @param string $sellerId
     */
    public function setSellerId(string $sellerId): void
    {
        $this->sellerId = $sellerId;
    }
}