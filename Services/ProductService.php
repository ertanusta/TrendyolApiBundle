<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * ProductService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class ProductService extends AbstractService
{

    public const PRODUCT_CREATE = "product_create";
    public const PRICE_STOCK_UPDATE = "price_stock_update";
    public const PRODUCT_LISTINGS = "product_listings";

    /**
     * @param array $productList
     * @return ResponseInterface
     */
    public function createProduct(array $productList = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::PRODUCT_CREATE),
            Request::METHOD_POST,
            $productList,
            []
        );
    }

    /**
     * @param array $productList
     * @return ResponseInterface
     */
    public function updateProduct(array $productList = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::PRODUCT_CREATE),
            Request::METHOD_PUT,
            $productList
        );
    }

    /**
     * @param array $productList
     * @return ResponseInterface
     */
    public function updatePriceStock(array $productList = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::PRICE_STOCK_UPDATE),
            Request::METHOD_PUT,
            $productList
        );
    }

    /**
     * @param array $queryParam
     * @return ResponseInterface
     */
    public function filterProducts(array $queryParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::PRODUCT_LISTINGS),
            Request::METHOD_GET,
            [],
            $queryParam
        );
    }
}