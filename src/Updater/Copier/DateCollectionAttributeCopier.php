<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Updater\Copier;

use Pim\Bundle\DateCollectionTypeBundle\AttributeType\ExtendedAttributeTypes;
use Pim\Component\Catalog\Updater\Copier\BaseAttributeCopier;

/**
 * Copy a date collection
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionAttributeCopier extends BaseAttributeCopier
{
    /** @var [] */
    protected $supportedFromTypes = [ExtendedAttributeTypes::DATE_COLLECTION];

    /** @var [] */
    protected $supportedToTypes = [ExtendedAttributeTypes::DATE_COLLECTION];
}
