<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Contracts\HttpClient\ResponseInterface;

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
     */
    public function getShipmentProviders(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::SHIPMENT_PROVIDERS)
        );
    }

    /**
     * @return ResponseInterface
     */
    public function getSuppliersAddresses(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::SUPPLIERS_ADDRESSES)
        );
    }
}