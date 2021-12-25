<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * ClaimService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class ClaimService extends AbstractService
{
    public const GET_SHIPMENT_PACKAGE = "get_shipment_package";
    public const CREATE_CLAIM = "create_claim";
    public const APPROVE_CLAIM_LINE_ITEMS = "approve_claim_line_items";
    public const CREATE_CLAIM_ISSUE = "create_claim_issue";
    public const GET_CLAIM_ISSUE_REASONS = "get_claim_ıisue_reasons";
    public const GET_CLAIM_AUDITS = "get_claim_audits";

    /**
     * @param int $claimItemsId
     * @return ResponseInterface
     */
    public function getClaimAudits(int $claimItemsId = 0): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::GET_CLAIM_AUDITS, ['[claimItemsid]' => $claimItemsId])
        );
    }

    /**
     * @return ResponseInterface
     */
    public function getClaimsIssueReasons(): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::GET_CLAIM_ISSUE_REASONS)
        );
    }

    /**
     * @param int $claimId
     * @param array $queryParam
     * @return ResponseInterface
     */
    public function createClaimIssue(int $claimId = 0, array $queryParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::CREATE_CLAIM_ISSUE, ['[claimId]' => $claimId]),
            Request::METHOD_POST,
            [],
            $queryParam
        );
    }

    /**
     * @param int $claimId
     * @param array $bodyParam
     * @return ResponseInterface
     */
    public function approveClaimLineItems(int $claimId = 0, array $bodyParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::APPROVE_CLAIM_LINE_ITEMS, ['[claimId]' => $claimId]),
            Request::METHOD_PUT,
            $bodyParam
        );
    }

    /**
     * @param array $bodyParam
     * @return ResponseInterface
     */
    public function createClaim(array $bodyParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::CREATE_CLAIM),
            Request::METHOD_POST,
            $bodyParam
        );
    }

    /**
     * @param array $queryParam
     * @return ResponseInterface
     */
    public function getShipmentPackage(array $queryParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::GET_SHIPMENT_PACKAGE),
            Request::METHOD_GET,
            [],
            $queryParam
        );
    }
}