<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\CargoService;
use Trendyol\ApiBundle\Services\CategoryService;

class CategoryServiceTest extends TestCase
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

    public function testGetCategoryTree()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CategoryService::CATEGORY_LIST)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);

        $categoryService = new CategoryService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getCategoryTree());
    }

    public function testGetCategoryAttributes()
    {
        $categoryId = 1;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CategoryService::CATEGORY_ATTRIBUTES, ['[categoryid]' => $categoryId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);

        $categoryService = new CategoryService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getCategoryAttributes($categoryId));
    }

    public function testGetBrands()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CategoryService::BRAND_LIST)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);
        $categoryService = new CategoryService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getBrands());
    }

    public function testGetBrandsName()
    {
        $brandName = "brand";
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CategoryService::BRAND_BY_NAME)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], ['name' => $brandName]);
        $categoryService = new CategoryService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getBrandsName($brandName));
    }
}