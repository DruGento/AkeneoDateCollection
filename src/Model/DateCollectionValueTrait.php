<?php

namespace Pim\Bundle\DateCollectionTypeBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trait to reuse in the overridden ProductValue on the dedicated project
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
trait DateCollectionValueTrait
{
    /** @var ArrayCollection */
    protected $dateCollection;

    /**
     * @return ArrayCollection
     */
    public function getDateCollection()
    {
        return $this->dateCollection;
    }

    /**
     * @param []|null $collection
     */
    public function setDateCollection($collection)
    {
        $this->dateCollection = $collection;
    }

    /**
     * @param mixed $value
     */
    public function addDateCollectionItem($value)
    {
        $this->dateCollection[] = $value;
    }
}
