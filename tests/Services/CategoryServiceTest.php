<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\CategoryService;

class CategoryServiceTest extends TestCase
{
    private function getClientMock()
    {
        return $this->createMock(TrendyolClient::class);
    }

    private function getUrlFactoryMock()
    {
        return $this->createMock(TrendyolUrlFactory::class);
    }

    public function testGetCategoryTree()
    {
        $client = $this->getClientMock();
        $client
            ->expects($this->once())
            ->method('request')
            ->with(CategoryService::CATEGORY_LIST, Request::METHOD_GET, [], []);
        $categoryService = new CategoryService($client);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getCategoryTree());
    }

    public function testGetCategoryAttributes()
    {
        $categoryId = "123";
        $client = $this->getClientMock();
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                str_replace('{categoryid}', $categoryId, CategoryService::CATEGORY_ATTRIBUTES),
                Request::METHOD_GET,
                [],
                []
            );
        $categoryService = new CategoryService($client);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getCategoryAttributes($categoryId));
    }

    public function testGetBrands()
    {
        $client = $this->getClientMock();
        $client
            ->expects($this->once())
            ->method('request')
            ->with(CategoryService::BRAND_LIST_ENDPOINT, Request::METHOD_GET, [], []);
        $categoryService = new CategoryService($client);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getBrands());
    }

    public function testGetBrandsName()
    {
        $brandName = "brand";
        $client = $this->getClientMock();
        $client
            ->expects($this->once())
            ->method('request')
            ->with(CategoryService::BRAND_BY_NAME_ENDPOINT, Request::METHOD_GET, [], ['name' => $brandName]);
        $categoryService = new CategoryService($client);
        $this->assertInstanceOf(ResponseInterface::class, $categoryService->getBrandsName($brandName));
    }
}