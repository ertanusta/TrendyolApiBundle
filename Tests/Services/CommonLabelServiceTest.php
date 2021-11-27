<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Services\CommonLabelService;

class CommonLabelServiceTest extends TestCase
{
	private function getClientMock()
	{
		return $this->createMock(TrendyolClient::class);
	}

	public function testCreateCommonLabel()
	{
		$cargoTrackingNumber = "1231";
		$bodyParam = [];
		$queryParam = [ 'format' => 'ZPL' ];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{cargoTrackingNumber}', $cargoTrackingNumber, CommonLabelService::CREATE_COMMON_LABEL_ENDPOINT),
				Request::METHOD_POST,
				$bodyParam,
				$queryParam
			);
		$commonLabelService = new CommonLabelService($client);
		$this->assertInstanceOf(ResponseInterface::class, $commonLabelService->createCommonLabel($cargoTrackingNumber, $bodyParam, $queryParam));
	}

	public function testGetCommonLabel()
	{
		$cargoTrackingNumber = "1231";
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{cargoTrackingNumber}', $cargoTrackingNumber, CommonLabelService::GET_COMMON_LABEL_ENDPOINT),
				Request::METHOD_GET,
				[],
				[]
			);
		$commonLabelService = new CommonLabelService($client);
		$this->assertInstanceOf(ResponseInterface::class, $commonLabelService->getCommonLabel($cargoTrackingNumber));
	}
}