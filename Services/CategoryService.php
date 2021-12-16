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

    public const CATEGORY_LIST = "category_list";
    public const CATEGORY_ATTRIBUTES = "category_attributes";
    public const BRAND_LIST = "brand_list";
    public const BRAND_BY_NAME = "brand_by_name";

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
     */
    public function getCategoryTree(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::CATEGORY_LIST)
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
            $this->getUrlFactory()->createUrl(self::CATEGORY_ATTRIBUTES, ['[categoryid]' => $categoryId])
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
            $this->getUrlFactory()->createUrl(self::BRAND_LIST)
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
            $this->getUrlFactory()->createUrl(self::BRAND_BY_NAME),
            Request::METHOD_GET,
            [],
            ['name' => $brandName]
        );
    }
}