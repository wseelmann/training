<?php
namespace In2code\Translation\Domain\Model;

/***
 *
 * This file is part of the "translation" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Alex Kellne <alexander.kellner@in2code.de>, in2code GmbH
 *
 ***/

/**
 * Trans
 */
class Trans extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * customer
     *
     * @var string
     */
    protected $customer = '';

    /**
     * fromLanguage
     *
     * @var string
     */
    protected $fromLanguage = '';

    /**
     * toLanguage
     *
     * @var string
     */
    protected $toLanguage = '';

    /**
     * subjectFrom
     *
     * @var string
     */
    protected $subjectFrom = '';

    /**
     * subjectTo
     *
     * @var string
     */
    protected $subjectTo = '';

    /**
     * @var \DateTime
     */
    protected $tstamp = null;

    /**
     * Returns the customer
     *
     * @return string $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the customer
     *
     * @param string $customer
     * @return void
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Returns the fromLanguage
     *
     * @return string $fromLanguage
     */
    public function getFromLanguage()
    {
        return $this->fromLanguage;
    }

    /**
     * Sets the fromLanguage
     *
     * @param string $fromLanguage
     * @return void
     */
    public function setFromLanguage($fromLanguage)
    {
        $this->fromLanguage = $fromLanguage;
    }

    /**
     * Returns the toLanguage
     *
     * @return string $toLanguage
     */
    public function getToLanguage()
    {
        return $this->toLanguage;
    }

    /**
     * Sets the toLanguage
     *
     * @param string $toLanguage
     * @return void
     */
    public function setToLanguage($toLanguage)
    {
        $this->toLanguage = $toLanguage;
    }

    /**
     * Returns the subjectFrom
     *
     * @return string $subjectFrom
     */
    public function getSubjectFrom()
    {
        return $this->subjectFrom;
    }

    /**
     * Sets the subjectFrom
     *
     * @param string $subjectFrom
     * @return void
     */
    public function setSubjectFrom($subjectFrom)
    {
        $this->subjectFrom = $subjectFrom;
    }

    /**
     * Returns the subjectTo
     *
     * @return string $subjectTo
     */
    public function getSubjectTo()
    {
        return $this->subjectTo;
    }

    /**
     * Sets the subjectTo
     *
     * @param string $subjectTo
     * @return void
     */
    public function setSubjectTo($subjectTo)
    {
        $this->subjectTo = $subjectTo;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param \DateTime $tstamp
     * @return void
     */
    public function setTstamp(\DateTime $tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * Check if last change is older then 1 year
     *      get it in view with {object.tooOld}
     *
     * @return bool
     */
    public function isTooOld(): bool
    {
        $now = new \DateTime();
        $yearsAgo = $now->diff($this->getTstamp())->y;
        return $yearsAgo >= 1;
    }
}
