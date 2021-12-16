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

    public const PRODUCT_CREATE = "product_create";
    public const PRICE_STOCK_UPDATE = "price_stock_update";
    public const PRODUCT_LISTINGS = "product_listings";

    /**
     * @param array $productList
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
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
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
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
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
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
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
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