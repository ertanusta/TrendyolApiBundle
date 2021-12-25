<?php

namespace Trendyol\ApiBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Client\TrendyolClient;
use Trendyol\ApiBundle\Factories\TrendyolUrlFactory;
use Trendyol\ApiBundle\Services\ClaimService;

class ClaimServiceTest extends TestCase
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

    public function testGetClaimAudits()
    {
        $claimItemsId = 123;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::GET_CLAIM_AUDITS, ['[claimItemsid]' => $claimItemsId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->getClaimAudits($claimItemsId));
    }

    public function testGetClaimsIssueReasons()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::GET_CLAIM_ISSUE_REASONS)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->getClaimsIssueReasons());
    }

    public function testCreateClaimIssue()
    {
        $claimId = 123;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::CREATE_CLAIM_ISSUE, ['[claimId]' => $claimId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_POST, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->createClaimIssue($claimId, []));
    }

    public function testApproveClaimLineItems()
    {
        $claimId = 123;
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::APPROVE_CLAIM_LINE_ITEMS, ['[claimId]' => $claimId])
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_PUT, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->approveClaimLineItems($claimId, []));
    }

    public function testCreateClaim()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::CREATE_CLAIM)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_POST, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->createClaim([]));
    }

    public function testGetShipmentPackage()
    {
        $client = $this->getClientMock();
        $urlFactory = $this->getUrlFactoryMock();

        $urlFactory
            ->expects($this->once())
            ->method('createUrl')
            ->with(ClaimService::GET_SHIPMENT_PACKAGE)
            ->willReturn(self::URL);

        $client
            ->expects($this->once())
            ->method('request')
            ->with(self::URL, Request::METHOD_GET, [], []);


        $cargoService = new ClaimService($client, $urlFactory);
        $this->assertInstanceOf(ResponseInterface::class, $cargoService->getShipmentPackage([]));
    }
}