<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * CategoryService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class CategoryService extends AbstractService
{

	public const CATEGORY_LIST_ENDPOINT = "/sapigw/product-categories";
	public const CATEGORY_ATTRIBUTES_ENDPOINT = "/sapigw/product-categories/{categoryid}/attributes";
	public const BRAND_LIST_ENDPOINT = "/sapigw/brands";
	public const BRAND_BY_NAME_ENDPOINT = "/sapigw/brands/by-name";

	/**
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getCategoryTree(): ResponseInterface
	{
		return $this->getClient()->request(
			self::CATEGORY_LIST_ENDPOINT
		);
	}

	/**
	 * @param string $categoryId
	 * @return ResponseInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 * @throws \Trendyol\ApiBundle\Exceptions\HeaderNotFoundException
	 */
	public function getCategoryAttributes(string $categoryId = ""): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{categoryid}', $categoryId, self::CATEGORY_ATTRIBUTES_ENDPOINT)
		);
	}

	/**
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getBrands(): ResponseInterface
	{
		return $this->getClient()->request(
			self::BRAND_LIST_ENDPOINT
		);
	}

	/**
	 * @param string $brandName
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getBrandsName(string $brandName = ""): ResponseInterface
	{
		return $this->getClient()->request(
			self::BRAND_BY_NAME_ENDPOINT,
			Request::METHOD_GET,
			[],
			[ 'name' => $brandName ]
		);
	}
}