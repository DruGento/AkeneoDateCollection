<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Validator\ConstraintGuesser;

use Pim\Bundle\DateCollectionTypeBundle\AttributeType\ExtendedAttributeTypes;
use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Validator\ConstraintGuesser\EmailGuesser;
use Pim\Component\Catalog\Validator\ConstraintGuesser\RegexGuesser;
use Pim\Component\Catalog\Validator\ConstraintGuesser\UrlGuesser;
use Pim\Component\Catalog\Validator\ConstraintGuesserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Validation guesser for the date collection attribute type.
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class DateCollectionGuesser implements ConstraintGuesserInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportAttribute(AttributeInterface $attribute)
    {
        return $attribute->getType() === ExtendedAttributeTypes::DATE_COLLECTION;
    }

    /**
     * {@inheritdoc}
     */
    public function guessConstraints(AttributeInterface $attribute)
    {
        $constraints = [];
        $guesser = null;

        if ('url' === $attribute->getValidationRule()) {
            $guesser = new UrlGuesser();
        } elseif ('regexp' === $attribute->getValidationRule() && $pattern = $attribute->getValidationRegexp()) {
            $guesser = new RegexGuesser();
        } elseif ('email' === $attribute->getValidationRule()) {
            $guesser = new EmailGuesser();
        }

        if (null !== $guesser) {
            return [
                new Assert\All(['constraints' => $guesser->guessConstraints($attribute)])
            ];
        }

        return $constraints;
    }
}
