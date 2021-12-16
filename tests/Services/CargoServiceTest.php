<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Services\CargoService;

class CargoServiceTest extends TestCase
{
	private function getClientMock()
	{
		return $this->createMock(TrendyolClient::class);
	}

	public function testGetShipmentProviders()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(CargoService::SHIPMENT_PROVIDERS_ENDPOINT, Request::METHOD_GET, [], []);
		$cargoService = new CargoService($client);
		$this->assertInstanceOf(ResponseInterface::class, $cargoService->getShipmentProviders());
	}

	public function testGetSuppliersAddresses()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(CargoService::SUPPLIERS_ADDRESSES_ENDPOINT, Request::METHOD_GET, [], []);
		$cargoService = new CargoService($client);
		$this->assertInstanceOf(ResponseInterface::class, $cargoService->getSuppliersAddresses());
	}
}