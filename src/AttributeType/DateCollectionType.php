<?php

namespace Pim\Bundle\DateCollectionTypeBundle\AttributeType;

use Pim\Bundle\CatalogBundle\AttributeType\AbstractAttributeType;
use Pim\Component\Catalog\Model\AttributeInterface;

/**
 * Date collection attribute type
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionType extends AbstractAttributeType
{
    /** @var string List separator for flat format */
    const FLAT_SEPARATOR = ',';

    /**
     * {@inheritdoc}
     */
    protected function defineCustomAttributeProperties(AttributeInterface $attribute)
    {
        $properties = parent::defineCustomAttributeProperties($attribute) + [
                'validationRule' => [
                    'name'      => 'validationRule',
                    'fieldType' => 'choice',
                    'options'   => [
                        'choices' => [
                            null     => 'None',
                            'email'  => 'E-mail',
                            'url'    => 'URL',
                            'regexp' => 'Regular expression'
                        ],
                        'select2' => true
                    ]
                ],
                'validationRegexp' => [
                    'name' => 'validationRegexp'
                ]
            ];

        $properties['unique']['options']['disabled'] = true;
        $properties['unique']['options']['read_only'] = true;

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return ExtendedAttributeTypes::DATE_COLLECTION;
    }
}
