<?php

namespace Trendyol\ApiBundle\Factories;

interface UrlFactoryInterface
{
    public function createUrl(string $serviceName,array $arguments = []):string;

    public function setSellerId(string $sellerId);

}