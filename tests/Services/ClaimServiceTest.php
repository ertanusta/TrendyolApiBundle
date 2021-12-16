<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Services\ClaimService;

class ClaimServiceTest extends TestCase
{
	private function getClientMock()
	{
		return $this->createMock(TrendyolClient::class);
	}

	public function testGetClaimAuditsAppDebugTrue()
	{
		$_SERVER['APP_DEBUG'] = 1;
		$claimItemsId = 0;
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{claimItemsId}', $claimItemsId, ClaimService::GET_CLAIM_AUDITS_ENDPOINT),
				Request::METHOD_GET,
				[],
				[]
			);
		$supplierId = $client->getSupplierId();
		$client->setUrl("https://stageapi.trendyol.com/integration/oms/core/sellers/$supplierId/");
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->getClaimAudits($claimItemsId));
	}

	public function testGetClaimAuditsAppDebugFalse()
	{
		$_SERVER['APP_DEBUG'] = 0;
		$claimItemsId = 0;
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{claimItemsId}', $claimItemsId, ClaimService::GET_CLAIM_AUDITS_ENDPOINT),
				Request::METHOD_GET,
				[],
				[]
			);
		$supplierId = $client->getSupplierId();
		$client->setUrl("https://api.trendyol.com/integration/oms/core/sellers/$supplierId/");
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->getClaimAudits($claimItemsId));
	}

	public function testGetClaimsIssueReasons()
	{
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ClaimService::GET_CLAIM_ISSUE_REASONS_ENDPOINT, Request::METHOD_GET, [], []);
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->getClaimsIssueReasons());
	}

	public function testCreateClaimIssue()
	{
		$claimId = 0;
		$queryParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{claimId}', $claimId, ClaimService::CREATE_CLAIM_ISSUE_ENDPOINT),
				Request::METHOD_POST,
				[],
				$queryParam
			);
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->createClaimIssue($claimId, $queryParam));
	}

	public function testApproveClaimLineItems()
	{
		$claimId = 0;
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(
				str_replace('{claimId}', $claimId, ClaimService::APPROVE_CLAIM_LINE_ITEMS_ENDPOINT),
				Request::METHOD_PUT,
				$bodyParam,
				[]
			);
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->approveClaimLineItems($claimId, $bodyParam));
	}

	public function testCreateClaim()
	{
		$bodyParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ClaimService::CREATE_CLAIM_ENDPOINT, Request::METHOD_POST, $bodyParam, []);
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->createClaim($bodyParam));
	}

	public function testGetShipmentPackage()
	{
		$queryParam = [];
		$client = $this->getClientMock();
		$client
			->expects($this->once())
			->method('request')
			->with(ClaimService::GET_SHIPMENT_PACKAGE_ENDPOINT, Request::METHOD_GET, [], $queryParam);
		$claimService = new ClaimService($client);
		$this->assertInstanceOf(ResponseInterface::class, $claimService->getShipmentPackage($queryParam));
	}
}