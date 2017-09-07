<?php

namespace Pim\Bundle\DateCollectionTypeBundle\ArrayConverter\StandardToFlat\Product\ValueConverter;

use Pim\Bundle\DateCollectionTypeBundle\AttributeType\DateCollectionType;
use Pim\Component\Connector\ArrayConverter\StandardToFlat\Product\ValueConverter\AbstractValueConverter;
use Pim\Component\Connector\ArrayConverter\StandardToFlat\Product\ValueConverter\ValueConverterInterface;

/**
 * Date collection array converter.
 * Convert a DateCollection array format to a flat one.
 *
 * DateCollection array format:
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
 * It will return:
 * [
 *      'schedule-en_US-ecommerce' => "[{"startDate":"10.08.2017","startTime":"10:00","endDate":"09.09.2017","endTime":"22:30","weekdays":["Mo","Tu","We","Th","Fr"]}]",
 * ]
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionConverter extends AbstractValueConverter implements ValueConverterInterface
{
    /**
     * Converts a value
     *
     * @param string $attributeCode
     * @param mixed  $data
     *
     * @return array
     */
    public function convert($attributeCode, $data)
    {
        $convertedItem = [];

        foreach ($data as $value) {
            $flatName = $this->columnsResolver->resolveFlatAttributeName(
                $attributeCode,
                $value['locale'],
                $value['scope']
            );

            $convertedItem[$flatName] = json_encode($value['data']);
        }

        return $convertedItem;
    }
}
