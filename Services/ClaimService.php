<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * ClaimService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class ClaimService extends AbstractService
{
	public const GET_SHIPMENT_PACKAGE_ENDPOINT = "/sapigw/suppliers/{sellerid}/claims";
	public const CREATE_CLAIM_ENDPOINT = "/sapigw/suppliers/{supplierId}/claims/create";
	public const APPROVE_CLAIM_LINE_ITEMS_ENDPOINT = "/sapigw/claims/{claimId}/items/approve";
	public const CREATE_CLAIM_ISSUE_ENDPOINT = "/sapigw/claims/{claimId}/issue";
	public const GET_CLAIM_ISSUE_REASONS_ENDPOINT = "/sapigw/claim-issue-reasons";
	public const GET_CLAIM_AUDITS_ENDPOINT = "/integration/oms/core/sellers/{sellerid}/claims/items/{claimItemsId}/audit";

	/**
	 * @param int $claimItemsId
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getClaimAudits(int $claimItemsId = 0): ResponseInterface
    {
		return $this->getClient()->request(
			str_replace('{claimItemsId}', $claimItemsId, self::GET_CLAIM_AUDITS_ENDPOINT)
		);
	}

	/**
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getClaimsIssueReasons(): ResponseInterface
    {
		return $this->getClient()->request(self::GET_CLAIM_ISSUE_REASONS_ENDPOINT);
	}

	/**
	 * @param int $claimId
	 * @param array $queryParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function createClaimIssue(int $claimId = 0, array $queryParam = []): ResponseInterface
    {
		return $this->getClient()->request(
			str_replace('{claimId}', $claimId, self::CREATE_CLAIM_ISSUE_ENDPOINT),
			Request::METHOD_POST,
			[],
			$queryParam
		);
	}

	/**
	 * @param int $claimId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function approveClaimLineItems(int $claimId = 0, array $bodyParam = []): ResponseInterface
    {
		return $this->getClient()->request(
			str_replace('{claimId}', $claimId, self::APPROVE_CLAIM_LINE_ITEMS_ENDPOINT),
			Request::METHOD_PUT,
			$bodyParam
		);
	}

	/**
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function createClaim(array $bodyParam = []): ResponseInterface
    {
		return $this->getClient()->request(
			self::CREATE_CLAIM_ENDPOINT,
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param array $queryParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getShipmentPackage(array $queryParam = []): ResponseInterface
    {
		return $this->getClient()->request(
			self::GET_SHIPMENT_PACKAGE_ENDPOINT,
			Request::METHOD_GET,
			[],
			$queryParam
		);
	}
}