<?php

namespace Trendyol\ApiBundle\Services;

use Trendyol\ApiBundle\Client\ClientInterface;

/**
 * AbstractService
 * @author Ertan USTA <ertanusta@outlook.com>
 */
abstract class AbstractService
{
	/**
	 * @var ClientInterface
	 */
	private $client;

	public function __construct(ClientInterface $client = null)
	{
		$this->client = $client;
	}

	/**
	 * @return ClientInterface
	 */
	protected function getClient(): ClientInterface
	{
		return $this->client;
	}
}