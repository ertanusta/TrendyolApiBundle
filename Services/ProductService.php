<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * ProductService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class ProductService extends AbstractService
{

	public const PRODUCT_ENDPOINT = "suppliers/{supplierid}/v2/products";
	public const PRICE_STOCK_ENDPOINT = "suppliers/{supplierid}/products/price-and-inventory";
	public const PRODUCT_LISTINGS = "suppliers/{supplierid}/products";

	/**
	 * @param array $productList
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function createProduct(array $productList = []): ResponseInterface
	{
		return $this->getClient()->request(
			self::PRODUCT_ENDPOINT,
			Request::METHOD_POST,
			$productList,
			[]
		);
	}

	/**
	 * @param array $productList
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updateProduct(array $productList = [])
	{
		return $this->getClient()->request(
			self::PRODUCT_ENDPOINT,
			Request::METHOD_PUT,
			$productList
		);
	}

	/**
	 * @param array $productList
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updatePriceStock(array $productList = [])
	{
		return $this->getClient()->request(
			self::PRICE_STOCK_ENDPOINT,
			Request::METHOD_PUT,
			$productList
		);
	}

	/**
	 * @param array $queryParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function filterProducts(array $queryParam = [])
	{
		return $this->getClient()->request(
			self::PRODUCT_LISTINGS,
			Request::METHOD_GET,
			[],
			$queryParam
		);
	}

	/**
	 * @param string $integrator
	 */
	public function setIntegrator(string $integrator): void
	{
		$this->getClient()->setIntegrator($integrator);
	}

	/**
	 * @param string $supplierId
	 */
	public function setSupplierId(string $supplierId): void
	{
		$this->getClient()->setSupplierId($supplierId);
	}

	/**
	 * @param string $appSecret
	 */
	public function setAppSecret(string $appSecret): void
	{
		$this->getClient()->setAppSecret($appSecret);
	}

	/**
	 * @param string $appKey
	 */
	public function setAppKey(string $appKey): void
	{
		$this->getClient()->setAppKey($appKey);
	}
}