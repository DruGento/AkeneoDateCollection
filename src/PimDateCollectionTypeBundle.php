<?php

namespace Pim\Bundle\DateCollectionTypeBundle;

use Pim\Bundle\ElasticSearchBundle\Query\ProductQueryUtility;
use Pim\Bundle\DateCollectionTypeBundle\AttributeType\ExtendedAttributeTypes;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author   Nickolay Konchits <nick@akeneo.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class PimDateCollectionTypeBundle extends Bundle
{
    public function boot()
    {
        parent::boot();

        $registeredBundles = $this->container->getParameter('kernel.bundles');
        if (array_key_exists('PimElasticSearchBundle', $registeredBundles)) {
            ProductQueryUtility::addTypeSuffix(ExtendedAttributeTypes::DATE_COLLECTION, ProductQueryUtility::SUFFIX_TEXT);
        }
    }
}
