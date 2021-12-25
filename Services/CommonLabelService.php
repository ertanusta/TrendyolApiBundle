<?php

namespace Trendyol\ApiBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * CommonLabelService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class CommonLabelService extends AbstractService
{

    public const CREATE_COMMON_LABEL = "create_common_label";
    public const GET_COMMON_LABEL = "get_common_label";

    /**
     * @param string $cargoTrackingNumber
     * @param array $bodyParam
     * @param array|string[] $queryParam
     * @return ResponseInterface
     */
    public function createCommonLabel(string $cargoTrackingNumber = "", array $bodyParam = [], array $queryParam = ['format' => 'ZPL']): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::CREATE_COMMON_LABEL, ['[cargoTrackingNumber]' => $cargoTrackingNumber]),
            Request::METHOD_POST,
            $bodyParam,
            $queryParam
        );
    }

    /**
     * @param string $cargoTrackingNumber
     * @return ResponseInterface
     */
    public function getCommonLabel(string $cargoTrackingNumber = ""): ResponseInterface
    {
        return $this->getClient()->request(
            $this->getUrlFactory()->createUrl(self::GET_COMMON_LABEL, ['[cargoTrackingNumber]' => $cargoTrackingNumber])
        );
    }
}