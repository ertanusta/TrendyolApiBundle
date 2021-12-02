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

	public const PRODUCT_ENDPOINT = "/sapigw/suppliers/{sellerid}/v2/products";
	public const PRICE_STOCK_ENDPOINT = "/sapigw/suppliers/{sellerid}/products/price-and-inventory";
	public const PRODUCT_LISTINGS = "/sapigw/suppliers/{sellerid}/products";

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
	public function updateProduct(array $productList = []): ResponseInterface
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
	public function updatePriceStock(array $productList = []): ResponseInterface
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
	public function filterProducts(array $queryParam = []): ResponseInterface
    {
		return $this->getClient()->request(
			self::PRODUCT_LISTINGS,
			Request::METHOD_GET,
			[],
			$queryParam
		);
	}
}