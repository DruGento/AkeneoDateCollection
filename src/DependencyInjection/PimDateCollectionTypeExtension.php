<?php

namespace Pim\Bundle\DateCollectionTypeBundle\DependencyInjection;

use Pim\Bundle\ElasticSearchBundle\Query\ProductQueryUtility;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * DI for the DateCollectionType bundle
 *
 * @author   Nickolay Konchits <nick@akeneo.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class PimDateCollectionTypeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ .'/../Resources/config'));
        $loader->load('array_converters.yml');
        $loader->load('attribute_types.yml');
        $loader->load('comparators.yml');
        $loader->load('completeness.yml');
        $loader->load('normalizers.yml');
        $loader->load('denormalizers.yml');
        $loader->load('providers.yml');
        $loader->load('updaters.yml');
        $loader->load('validators.yml');

        $loader->load('datagrid/attribute_types.yml');
        $loader->load('datagrid/formatters.yml');

        $this->loadAttributeIcons($loader, $container);

        $registeredBundles = $container->getParameter('kernel.bundles');
    }

    /**
     * Loads the attribute icons
     *
     * @param LoaderInterface $loader
     * @param ContainerBuilder $container
     */
    protected function loadAttributeIcons(LoaderInterface $loader, ContainerBuilder $container)
    {
        $loader->load('attribute_icons.yml');

        $icons = $container->getParameter('pim_enrich.attribute_icons');
        $icons += $container->getParameter('pim_extended_attribute_type.attribute_icons');

        $container->setParameter('pim_enrich.attribute_icons', $icons);
    }
}