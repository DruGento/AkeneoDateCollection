<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Normalizer\Flat;

use Pim\Bundle\DateCollectionTypeBundle\AttributeType\DateCollectionType;
use Pim\Bundle\VersioningBundle\Denormalizer\Flat\ProductValue\AbstractValueDenormalizer;

/**
 * Denormalize flat date collection:
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionDenormalizerFlat extends AbstractValueDenormalizer
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $data = ('' === $data) ? null : $data;

        if (null !== $data) {
            $data = json_decode($data);
        }

        return $data;
    }
}
