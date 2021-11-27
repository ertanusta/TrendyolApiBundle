<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Services\OrderService;

class OrderServiceTest extends TestCase
{
	private function getClientMock()
	{
		return $this->createMock(TrendyolClient::class);
	}

	public function testGetShipmentPackages()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(OrderService::SHIPMENT_PACKAGES_ENDPOINT, Request::METHOD_GET, [], []);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->getShipmentPackages([]));
	}

	public function testUpdateTrackingNumber()
	{
		$shipmentPackageId = 123;
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::UPDATE_TRACKING_ID_NUMBER_ENDPOINT),
				Request::METHOD_PUT,
				[],
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->updateTrackingNumber($shipmentPackageId));
	}

	public function testUpdatePackage()
	{
		$id = 35;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{Id}', $id, OrderService::UPDATE_PACKAGE_ENDPOINT),
				Request::METHOD_PUT,
				[],
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->updatePackage($id, $bodyParam));
	}

	public function testUpdatePackageUnSuppliedAppDebugTrue()
	{
		$_SERVER['APP_DEBUG'] = 1;
		$shipmentPackageId = 35;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::UPDATE_PACKAGE_UN_SUPPLIED_ENDPOINT),
				Request::METHOD_PUT,
				[],
				[]
			);
		$supplierId = $client->getSupplierId();
		$client->setUrl("https://stageapi.trendyol.com/integration/oms/core/sellers/$supplierId/");
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->updatePackageUnSupplied($shipmentPackageId, $bodyParam));
	}

	public function testUpdatePackageUnSuppliedAppDebugFalse()
	{
		$_SERVER['APP_DEBUG'] = 0;
		$shipmentPackageId = 35;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::UPDATE_PACKAGE_UN_SUPPLIED_ENDPOINT),
				Request::METHOD_PUT,
				[],
				[]
			);
		$supplierId = $client->getSupplierId();
		$client->setUrl("https://api.trendyol.com/integration/oms/core/sellers/$supplierId/");
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->updatePackageUnSupplied($shipmentPackageId, $bodyParam));
	}

	public function testSendInvoiceLink()
	{
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(OrderService::SEND_INVOICE_LINK_ENDPOINT, Request::METHOD_POST, $bodyParam, []);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->sendInvoiceLink($bodyParam));
	}

	public function testSplitMultiPackageByQuantity()
	{
		$shipmentPackageId = 33;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::SPLIT_MULTI_PACKAGE_BY_QUANTITY_ENDPOINT),
				Request::METHOD_POST,
				$bodyParam,
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->splitMultiPackageByQuantity($shipmentPackageId, $bodyParam));
	}

	public function testSplitShipmentPackage()
	{
		$shipmentPackageId = 33;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::SPLIT_SHIPMENT_PACKAGE_ENDPOINT),
				Request::METHOD_POST,
				$bodyParam,
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->splitShipmentPackage($shipmentPackageId, $bodyParam));
	}

	public function testMultiSplitShipmentPackage()
	{
		$shipmentPackageId = 33;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::MULTI_SPLIT_SHIPMENT_PACKAGE_ENDPOINT),
				Request::METHOD_POST,
				$bodyParam,
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->multiSplitShipmentPackage($shipmentPackageId, $bodyParam));
	}

	public function testSplitShipmentPackageByQuantity()
	{
		$shipmentPackageId = 33;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY_ENDPOINT),
				Request::METHOD_POST,
				$bodyParam,
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->splitShipmentPackageByQuantity($shipmentPackageId, $bodyParam));
	}

	public function testUpdateBoxInfo()
	{
		$shipmentPackageId = 33;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{shipmentPackageId}', $shipmentPackageId, OrderService::UPDATE_BOX_INFO_ENDPOINT),
				Request::METHOD_PUT,
				$bodyParam,
				[]
			);
		$orderService = new OrderService($client);
		$this->assertInstanceOf(ResponseInterface::class, $orderService->updateBoxInfo($shipmentPackageId, $bodyParam));
	}
}