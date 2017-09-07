<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Filter;

use Pim\Bundle\EnrichBundle\Provider\Filter\FilterProviderInterface;
use Pim\Bundle\DateCollectionTypeBundle\AttributeType\ExtendedAttributeTypes;
use Pim\Component\Catalog\Model\AttributeInterface;

/**
 * Filter provider for date collection attribute
 *
 * This provider is registered via DI tag to add the date collection filter.
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class FilterProvider implements FilterProviderInterface
{
    /** @var array */
    protected $filters = [
        ExtendedAttributeTypes::DATE_COLLECTION => [
            'product-export-builder' => 'akeneo-attribute-date-collection-filter',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function getFilters($attribute)
    {
        return $this->filters[$attribute->getAttributeType()];
    }

    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return $element instanceof AttributeInterface &&
            in_array($element->getType(), array_keys($this->filters));
    }
}
