<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Services\ProductService;

class ProductServiceTest extends TestCase
{
	private function getClientMock()
	{
		return $this->createMock(TrendyolClient::class);
	}

	public function testCreateProduct()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ProductService::PRODUCT_ENDPOINT, Request::METHOD_POST, [], []);
		$productService = new ProductService($client);
		$this->assertInstanceOf(ResponseInterface::class, $productService->createProduct([]));
	}

	public function testUpdateProduct()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ProductService::PRODUCT_ENDPOINT, Request::METHOD_PUT, [], []);
		$productService = new ProductService($client);
		$this->assertInstanceOf(ResponseInterface::class, $productService->updateProduct([]));
	}

	public function testUpdatePriceStock()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ProductService::PRICE_STOCK_ENDPOINT, Request::METHOD_PUT, [], []);
		$productService = new ProductService($client);
		$this->assertInstanceOf(ResponseInterface::class, $productService->updatePriceStock([]));
	}

	public function testFilterProducts()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ProductService::PRODUCT_LISTINGS, Request::METHOD_GET, [], []);
		$productService = new ProductService($client);
		$this->assertInstanceOf(ResponseInterface::class, $productService->filterProducts([]));
	}
}