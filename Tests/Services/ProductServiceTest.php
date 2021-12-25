<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\CargoService;
use Trendyol\ApiBundle\Services\ProductService;

class ProductServiceTest extends TestCase
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

    public function testCreateProduct()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ProductService::PRODUCT_CREATE)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_POST, [], []);

        $productService = new ProductService($client, $urlFactory);

        $this->assertInstanceOf(ResponseInterface::class, $productService->createProduct([]));
    }

    public function testUpdateProduct()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ProductService::PRODUCT_CREATE)
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_PUT, [], []);
        $productService = new ProductService($client, $urlFactory);

        $this->assertInstanceOf(ResponseInterface::class, $productService->updateProduct([]));
    }

    public function testUpdatePriceStock()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ProductService::PRICE_STOCK_UPDATE)
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_PUT, [], []);
        $productService = new ProductService($client, $urlFactory);

        $this->assertInstanceOf(ResponseInterface::class, $productService->updatePriceStock([]));
    }

    public function testFilterProducts()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ProductService::PRODUCT_LISTINGS)
            ->willReturn(self::URL);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);
        $productService = new ProductService($client, $urlFactory);

        $this->assertInstanceOf(ResponseInterface::class, $productService->filterProducts([]));
    }
}