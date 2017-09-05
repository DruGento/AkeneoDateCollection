<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Normalizer\Flat;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;
use Doctrine\Common\Collections\Collection;


/**
 * Normalize a doctrine collection
 *
 * @author   Nickolay Konchits <nick@akeneo.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateCollectionNormalizerFlat extends SerializerAwareNormalizer implements NormalizerInterface
{
    /** @var string[] */
    protected $supportedFormats = ['flat'];

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Collection
            && in_array($format, $this->supportedFormats)
            && count($data) > 0 && count($data[0]) > 0
            && array_key_exists('weekdays', $data[0]);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $result = [];
        foreach ($object as $item) {
            $result[] = $item;
        }
        $data = json_encode($result);
        return [$context['field_name'] => $data];
    }

}
