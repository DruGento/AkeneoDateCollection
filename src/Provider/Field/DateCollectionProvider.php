<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Provider\Field;

use Pim\Bundle\EnrichBundle\Provider\Field\FieldProviderInterface;
use Pim\Bundle\DateCollectionTypeBundle\AttributeType\ExtendedAttributeTypes;

class DateCollectionProvider implements FieldProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getField($element)
    {
        return ExtendedAttributeTypes::DATE_COLLECTION;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return ExtendedAttributeTypes::DATE_COLLECTION === $element->getAttributeType();
    }
}
