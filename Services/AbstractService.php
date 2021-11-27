<?php

namespace Trendyol\ApiBundle\Services;

use Trendyol\ApiBundle\Client\TrendyolClient;
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
	protected $client;

	public function __construct(ClientInterface $client = null)
	{
		$this->client = $client;
	}

	/**
	 * @return ClientInterface
	 */
	protected function getClient(): ClientInterface
	{
		if ($this->client === null) {
			$this->client = new TrendyolClient();
		}
		return $this->client;
	}

	/**
	 * @param ClientInterface $client
	 */
	public function setClient(ClientInterface $client): void
	{
		$this->client = $client;
	}

}