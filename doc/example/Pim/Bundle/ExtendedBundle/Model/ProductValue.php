<?php
namespace Pim\Bundle\ExtendedBundle\Model;

use Pim\Bundle\DateCollectionTypeBundle\Model\DateCollectionValueTrait;
use Pim\Component\Catalog\Model\ProductValue as PimProductValue;

/**
 * Overrides the product value to take the range attribute type into account.
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ProductValue extends PimProductValue
{
    use DateCollectionValueTrait;
}