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
    public const SHIPMENT_PACKAGES = "shipment_packages";
    public const UPDATE_TRACKING_ID_NUMBER = "update_tracking_id_number";
    public const UPDATE_PACKAGE = "update_package";
    public const UPDATE_PACKAGE_UN_SUPPLIED = "update_package_un_supplied";
    public const SEND_INVOICE_LINK = "send_invoice_link";
    public const SPLIT_MULTI_PACKAGE_BY_QUANTITY = "split_multi_package_by_quantity";
    public const SPLIT_SHIPMENT_PACKAGE = "split_shipment_package";
    public const MULTI_SPLIT_SHIPMENT_PACKAGE = "multi_split_shipment_package";
    public const SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY = "split_shipment_package_by_quantity";
    public const UPDATE_BOX_INFO = "update_box_info";

    /**
     * @param array $queryParam
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws HeaderNotFoundException
     */
    public function getShipmentPackages(array $queryParam = []): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::SHIPMENT_PACKAGES),
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
            $this->getUrlFactory()->createUrl(self::UPDATE_TRACKING_ID_NUMBER, ['[shipmentPackageid]' => $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::UPDATE_PACKAGE, ['[id]' => $id]),
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
            $this->getUrlFactory()->createUrl(self::UPDATE_PACKAGE_UN_SUPPLIED, ['[shipmentPackageid]', $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::SEND_INVOICE_LINK),
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
            $this->getUrlFactory()->createUrl(self::SPLIT_MULTI_PACKAGE_BY_QUANTITY, ['[shipmentPackageid]', $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::SPLIT_SHIPMENT_PACKAGE, ['[shipmentPackageid]', $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::MULTI_SPLIT_SHIPMENT_PACKAGE, ['[shipmentPackageid]', $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::SPLIT_SHIPMENT_PACKAGE_BY_QUANTITY, ['[shipmentPackageid]', $shipmentPackageId]),
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
            $this->getUrlFactory()->createUrl(self::UPDATE_BOX_INFO, ['[shipmentPackageid]', $shipmentPackageId]),
            Request::METHOD_PUT,
            $bodyParam
        );
    }
}