<?php

namespace Trendyol\ApiBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Trendyol\ApiBundle\Client\ClientInterface;
use Symfony\Component\Yaml\Yaml;
use Trendyol\ApiBundle\Factories\UrlFactoryInterface;


class TrendyolApiExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');


        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition(ClientInterface::class);
        $definition->addArgument($config['supplier_id'] ?? '');
        $definition->addArgument($config['app_key'] ?? '');
        $definition->addArgument($config['app_secret'] ?? '');
        $definition->addArgument($config['integrator'] ?? '');

        $environment = $container->getParameter("kernel.environment");
        $definition = $container->getDefinition(UrlFactoryInterface::class);
        $urlFilePath = $config['url_file_path']?? __DIR__.'/../Resources/config/packages/'.$environment.'/trendyol_url.yaml';
        $definition->addArgument(Yaml::parseFile($urlFilePath));
    }
}