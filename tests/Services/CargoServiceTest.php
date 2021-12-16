<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\CargoService;

class CargoServiceTest extends TestCase
{
    public const URL = "url";
    private function getClientMock()
    {
        return $this->getMockBuilder(TrendyolClient::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs(["sellerId", "appKey", "appSecret", "integrator"])
            ->getMock();
    }

    private function getUrlFactoryMock()
    {
        return $this->getMockBuilder(TrendyolUrlFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testGetShipmentProviders()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CargoService::SHIPMENT_PROVIDERS)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);


        $cargoService = new CargoService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->getShipmentProviders());
    }

	public function testGetSuppliersAddresses()
	{
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CargoService::SUPPLIERS_ADDRESSES)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);

        $cargoService = new CargoService($client, $urlFactory);
		$this->assertInstanceOf(ResponseInterface::class, $cargoService->getSuppliersAddresses());
	}
}