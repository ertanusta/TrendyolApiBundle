<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * CargoService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class CargoService extends AbstractService
{
    public const SHIPMENT_PROVIDERS = 'shipment_providers';
    public const SUPPLIERS_ADDRESSES = 'suppliers_addresses';

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
     */
    public function getShipmentProviders(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::SHIPMENT_PROVIDERS)
        );
    }

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
     */
    public function getSuppliersAddresses(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::SUPPLIERS_ADDRESSES)
        );
    }
}