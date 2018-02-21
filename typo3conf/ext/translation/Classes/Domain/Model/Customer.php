<?php
namespace In2code\Translation\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Customer
 */
class Customer extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Customer
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }
}
