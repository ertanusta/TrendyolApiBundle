<?php

namespace Trendyol\ApiBundle\Services;

use Trendyol\ApiBundle\Client\ClientInterface;
use Trendyol\ApiBundle\Factories\UrlFactoryInterface;

/**
 * AbstractService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
abstract class AbstractService
{
    /**
     * @var ClientInterface|null
     */
    private $client;

    /**
     * @var UrlFactoryInterface|null
     */
    private $factory;

    public function __construct(ClientInterface $client = null, UrlFactoryInterface $factory = null)
    {
        $this->client = $client;
        $this->factory = $factory;
        if ($factory instanceof UrlFactoryInterface && $client instanceof ClientInterface){
            $this->factory->setSellerId($this->client->getSellerId());
        }
    }

    /**
     * @return ClientInterface
     */
    protected function getClient(): ?ClientInterface
    {
        return $this->client;
    }

    /**
     * @return UrlFactoryInterface
     */
    protected function getUrlFactory(): ?UrlFactoryInterface
    {
        return $this->factory;
    }

    /**
     * @param $sellerId
     */
    public function setSellerId($sellerId)
    {
        $this->getUrlFactory()->setSellerId($sellerId);
        $this->getClient()->setSellerId($sellerId);
    }

    /**
     * @param $appkey
     */
    public function setAppKey($appkey)
    {
        $this->getClient()->setAppKey($appkey);
    }

    /**
     * @param $appSecret
     */
    public function setAppSecret($appSecret)
    {
        $this->getClient()->setAppSecret($appSecret);
    }

    /**
     * @param $integrator
     */
    public function setIntegrator($integrator)
    {
        $this->getClient()->setIntegrator($integrator);
    }
}