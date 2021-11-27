<?php

namespace Trendyol\ApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Trendyol\ApiBundle\DependencyInjection\TrendyolApiExtension;

/**
 * TrendyolApiBundle
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class TrendyolApiBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->registerExtension(new TrendyolApiExtension());
	}
}