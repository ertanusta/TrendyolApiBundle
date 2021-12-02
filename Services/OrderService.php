<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Trendyol\ApiBundle\Exceptions\HeaderNotFoundException;

/**
 * OrderService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class OrderService extends AbstractService
{
	public const SHIPMENT_PACKAGES_ENDPOINT = "/sapigw/suppliers/{sellerid}/orders";
	public const UPDATE_TRACKING_ID_NUMBER_ENDPOINT = "/sapigw/suppliers/{supplierId}/{shipmentPackageId}/update-tracking-number";
	public const UPDATE_PACKAGE_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{Id}";
	public const UPDATE_PACKAGE_UN_SUPPLIED_ENDPOINT = "/integration/oms/core/sellers/{selledi}/shipment-packages/{shipmentPackageId}/items/unsupplied";
	public const SEND_INVOICE_LINK_ENDPOINT = "/sapigw/suppliers/{supplierId}/supplier-invoice-links";
	public const SPLIT_MULTI_PACKAGE_BY_QUANTITY_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/split-packages";
	public const SPLIT_SHIPMENT_PACKAGE_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/split";
	public const MULTI_SPLIT_SHIPMENT_PACKAGE_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/multi-split";
	public const SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/quantity-split";
	public const UPDATE_BOX_INFO_ENDPOINT = "/sapigw/suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/box-info";

	/**
	 * @param array $queryParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function getShipmentPackages(array $queryParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			self::SHIPMENT_PACKAGES_ENDPOINT,
			Request::METHOD_GET,
			[],
			$queryParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updateTrackingNumber(int $shipmentPackageId): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::UPDATE_TRACKING_ID_NUMBER_ENDPOINT),
			Request::METHOD_PUT
		);
	}

	/**
	 * @param int $id
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updatePackage(int $id, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{Id}', $id, self::UPDATE_PACKAGE_ENDPOINT),
			Request::METHOD_PUT,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updatePackageUnSupplied(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::UPDATE_PACKAGE_UN_SUPPLIED_ENDPOINT),
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
	public function sendInvoiceLink(array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			self::SEND_INVOICE_LINK_ENDPOINT,
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function splitMultiPackageByQuantity(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::SPLIT_MULTI_PACKAGE_BY_QUANTITY_ENDPOINT),
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function splitShipmentPackage(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::SPLIT_SHIPMENT_PACKAGE_ENDPOINT),
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function multiSplitShipmentPackage(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::MULTI_SPLIT_SHIPMENT_PACKAGE_ENDPOINT),
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function splitShipmentPackageByQuantity(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY_ENDPOINT),
			Request::METHOD_POST,
			$bodyParam
		);
	}

	/**
	 * @param int $shipmentPackageId
	 * @param array $bodyParam
	 * @return ResponseInterface
	 * @throws TransportExceptionInterface
	 * @throws HeaderNotFoundException
	 */
	public function updateBoxInfo(int $shipmentPackageId, array $bodyParam = []): ResponseInterface
	{
		return $this->getClient()->request(
			str_replace('{shipmentPackageId}', $shipmentPackageId, self::UPDATE_BOX_INFO_ENDPOINT),
			Request::METHOD_PUT,
			$bodyParam
		);
	}
}