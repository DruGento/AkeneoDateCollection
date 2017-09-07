<?php

namespace Pim\Bundle\DateCollectionTypeBundle\ArrayConverter\FlatToStandard\Product\ValueConverter;

use Pim\Bundle\DateCollectionTypeBundle\AttributeType\DateCollectionType;
use Pim\Component\Connector\ArrayConverter\FlatToStandard\Product\ValueConverter\ValueConverterInterface;

/**
 * Converts a date collection value from Akeneo PIM flat format to Akeneo PIM standard format
 *
 * Here is an example with the temperature attribute.
 * Flat format:
 * [
 *      'schedule-en_US-ecommerce' => "[{"startDate":"10.08.2017","startTime":"10:00","endDate":"09.09.2017","endTime":"22:30","weekdays":["Mo","Tu","We","Th","Fr"]}]",
 * ]
 *
 * Standard format:
 * [
 *      {
 *          "locale":en_US,
 *          "scope":ecommerce,
 *          "data":
 *              [
 *                  {
 *                      "startDate":"10.08.2017",
 *                      "startTime":"10:00",
 *                      "endDate":"09.09.2017",
 *                      "endTime":"22:30",
 *                      "weekdays":["Mo","Tu","We","Th","Fr"]
 *                  }
 *              ]
 *      }
 * ]
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionConverter implements ValueConverterInterface
{
    /** @var string[] */
    protected $supportedFieldTypes;

    /**
     * @param string[] $supportedFieldTypes
     */
    public function __construct(array $supportedFieldTypes)
    {
        $this->supportedFieldTypes = $supportedFieldTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsField($attributeType)
    {
        return in_array($attributeType, $this->supportedFieldTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function convert(array $attributeFieldInfo, $value)
    {
        if ('' === trim($value)) {
            return [];
        }

        return [
            $attributeFieldInfo['attribute']->getCode() => [[
                'locale' => $attributeFieldInfo['locale_code'],
                'scope'  => $attributeFieldInfo['scope_code'],
                'data'   => json_decode($value),
            ]],
        ];
    }
}
