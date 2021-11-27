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
	public const GET_SHIPMENT_PACKAGE_ENDPOINT = "suppliers/{supplierid}/claims";
	public const CREATE_CLAIM_ENDPOINT = "suppliers/{supplierId}/claims/create";
	public const APPROVE_CLAIM_LINE_ITEMS_ENDPOINT = "claims/{claimId}/items/approve";
	public const CREATE_CLAIM_ISSUE_ENDPOINT = "claims/{claimId}/issue";
	public const GET_CLAIM_ISSUE_REASONS_ENDPOINT = "claim-issue-reasons";
	public const GET_CLAIM_AUDITS_ENDPOINT = "claims/items/{claimItemsId}/audit";

	/**
	 * @param int $claimItemsId
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getClaimAudits(int $claimItemsId = 0)
	{
		$oldUrl = $this->getClient()->getUrl();
		$supplierId = $this->getClient()->getSupplierId();
		$this->getClient()->setUrl("https://stageapi.trendyol.com/integration/oms/core/sellers/$supplierId/");
		if ($_SERVER['APP_DEBUG'] === 0) {
			$this->getClient()->setUrl("https://api.trendyol.com/integration/oms/core/sellers/$supplierId/");
		}
		$response = $this->getClient()->request(
			str_replace('{claimItemsId}', $claimItemsId, self::GET_CLAIM_AUDITS_ENDPOINT)
		);
		$this->getClient()->setUrl($oldUrl);
		return $response;
	}

	/**
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getClaimsIssueReasons()
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
	public function createClaimIssue(int $claimId = 0, array $queryParam = [])
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
	public function approveClaimLineItems(int $claimId = 0, array $bodyParam = [])
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
	public function createClaim(array $bodyParam = [])
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
	public function getShipmentPackage(array $queryParam = [])
	{
		return $this->getClient()->request(
			self::GET_SHIPMENT_PACKAGE_ENDPOINT,
			Request::METHOD_GET,
			[],
			$queryParam
		);
	}
}