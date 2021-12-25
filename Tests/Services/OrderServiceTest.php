<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\OrderService;
use Trendyol\ApiBundle\Services\ProductService;

class OrderServiceTest extends TestCase
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

    public function testGetShipmentPackages()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::SHIPMENT_PACKAGES)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->getShipmentPackages([]));
    }

    public function testUpdateTrackingNumber()
    {
        $shipmentPackageId = 123;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::UPDATE_TRACKING_ID_NUMBER,['[shipmentPackageid]' => $shipmentPackageId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_PUT,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->updateTrackingNumber($shipmentPackageId));
    }

    public function testUpdatePackage()
    {
        $id = 35;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::UPDATE_PACKAGE,['[id]' => $id])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_PUT,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->updatePackage($id, []));
    }

    public function testUpdatePackageUnSupplied()
    {
        $shipmentPackageId = 35;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::UPDATE_PACKAGE_UN_SUPPLIED,['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_PUT,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->updatePackageUnSupplied($shipmentPackageId, []));
    }


    public function testSendInvoiceLink()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::SEND_INVOICE_LINK)
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_POST, [], []);
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->sendInvoiceLink([]));
    }

    public function testSplitMultiPackageByQuantity()
    {
        $shipmentPackageId = 33;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::SPLIT_MULTI_PACKAGE_BY_QUANTITY,['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_POST,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->splitMultiPackageByQuantity($shipmentPackageId, []));
    }

    public function testSplitShipmentPackage()
    {
        $shipmentPackageId = 33;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::SPLIT_SHIPMENT_PACKAGE,['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_POST,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->splitShipmentPackage($shipmentPackageId, []));
    }

    public function testMultiSplitShipmentPackage()
    {
        $shipmentPackageId = 33;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::MULTI_SPLIT_SHIPMENT_PACKAGE,['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_POST,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->multiSplitShipmentPackage($shipmentPackageId, []));
    }

    public function testSplitShipmentPackageByQuantity()
    {
        $shipmentPackageId = 33;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY, ['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_POST,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->splitShipmentPackageByQuantity($shipmentPackageId, []));
    }

    public function testUpdateBoxInfo()
    {
        $shipmentPackageId = 33;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(OrderService::UPDATE_BOX_INFO,['[shipmentPackageid]', $shipmentPackageId])
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                self::URL,
                Request::METHOD_PUT,
                [],
                []
            );
        $orderService = new OrderService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $orderService->updateBoxInfo($shipmentPackageId, []));
    }
}