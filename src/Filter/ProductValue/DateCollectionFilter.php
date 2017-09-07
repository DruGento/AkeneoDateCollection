<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Filter\ProductValue;

use Oro\Bundle\FilterBundle\Form\Type\Filter\FilterType;
use Oro\Bundle\FilterBundle\Form\Type\Filter\TextFilterType;
use Pim\Bundle\DateCollectionTypeBundle\DataGrid\Form\Type\Filter\DateCollectionFilterType;
use Pim\Bundle\FilterBundle\Filter\ProductValue\StringFilter;
use Pim\Component\Catalog\Query\Filter\Operators;

/**
 * DateCollectionFilter
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionFilter extends StringFilter
{
    /** @var array */
    protected $operatorTypes = [
        TextFilterType::TYPE_CONTAINS     => Operators::CONTAINS,
        TextFilterType::TYPE_NOT_CONTAINS => Operators::DOES_NOT_CONTAIN,
        FilterType::TYPE_EMPTY            => Operators::IS_EMPTY,
    ];

    /**
     * {@inheritDoc}
     */
    protected function getFormType()
    {
        return DateCollectionFilterType::NAME;
    }
}
