<?php

namespace Pim\Bundle\DateCollectionTypeBundle\DataGrid\Form\Type\Filter;

use Oro\Bundle\FilterBundle\Form\Type\Filter\FilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * DateCollectionFilterType to display the grid filter
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionFilterType extends AbstractType
{
    const TYPE_CONTAINS = 1;
    const TYPE_NOT_CONTAINS = 2;
    const TYPE_EMPTY = 3;

    const NAME = 'pim_type_date_collection_filter';

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return FilterType::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [
            self::TYPE_CONTAINS     => $this->translator->trans('oro.filter.form.label_type_contains'),
            self::TYPE_NOT_CONTAINS => $this->translator->trans('oro.filter.form.label_type_not_contains'),
            FilterType::TYPE_EMPTY  => $this->translator->trans('oro.filter.form.label_type_empty'),
        ];

        $resolver->setDefaults(
            [
                'field_type'       => 'text',
                'operator_choices' => $choices,
            ]
        );
    }
}
