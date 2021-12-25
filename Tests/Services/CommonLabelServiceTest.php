<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\CommonLabelService;

class CommonLabelServiceTest extends TestCase
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

	public function testCreateCommonLabel()
	{
		$cargoTrackingNumber = "1231";
		$queryParam = [ 'format' => 'ZPL' ];

        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();
        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CommonLabelService::CREATE_COMMON_LABEL, ['[cargoTrackingNumber]' => $cargoTrackingNumber])
            ->willReturn(self::URL);

		$client
			->expects($this->once())
			->method('request')
			->with(
				self::URL,
				Request::METHOD_POST,
				[],
				$queryParam
			);
		$commonLabelService = new CommonLabelService($client,$urlFactory);
		$this->assertInstanceOf(ResponseInterface::class, $commonLabelService->createCommonLabel($cargoTrackingNumber, [], $queryParam));
	}

	public function testGetCommonLabel()
	{
		$cargoTrackingNumber = "1231";
		$client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();
        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(CommonLabelService::GET_COMMON_LABEL, ['[cargoTrackingNumber]' => $cargoTrackingNumber])
            ->willReturn(self::URL);
		$client
			->expects($this->once())
			->method('request')
			->with(
				self::URL,
				Request::METHOD_GET,
				[],
				[]
			);
		$commonLabelService = new CommonLabelService($client,$urlFactory);
		$this->assertInstanceOf(ResponseInterface::class, $commonLabelService->getCommonLabel($cargoTrackingNumber));
	}
}