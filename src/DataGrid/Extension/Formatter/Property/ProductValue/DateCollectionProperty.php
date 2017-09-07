<?php

namespace Pim\Bundle\DateCollectionTypeBundle\DataGrid\Extension\Formatter\Property\ProductValue;

use Akeneo\Component\Localization\Presenter\PresenterInterface;
use Pim\Bundle\DataGridBundle\Extension\Formatter\Property\ProductValue\TwigProperty;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Formatter for Date Collection attribute type.
 * Works with a twig template (Resources/views/Property/date_collection.html.twig).
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionProperty extends TwigProperty
{
    /**
     * {@inheritdoc}
     */
    protected function convertValue($value)
    {
        $result = $this->getBackendData($value);

        return $this->getTemplate()->render(
            [
                'values'    => $result,
                'attribute' => $value['attribute'],
            ]
        );
    }
}
