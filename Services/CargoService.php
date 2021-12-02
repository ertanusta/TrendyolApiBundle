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
	public const SHIPMENT_PROVIDERS_ENDPOINT = 'shipment-providers';
	public const SUPPLIERS_ADDRESSES_ENDPOINT = 'suppliers/{sellerid}/addresses';

	/**
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getShipmentProviders(): ResponseInterface
	{
		return $this->getClient()->request(
			self::SHIPMENT_PROVIDERS_ENDPOINT
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
			self::SUPPLIERS_ADDRESSES_ENDPOINT
		);
	}
}