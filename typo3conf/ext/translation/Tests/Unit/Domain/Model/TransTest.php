<?php
namespace In2code\Translation\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Alex Kellne <alexander.kellner@in2code.de>
 */
class TransTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \In2code\Translation\Domain\Model\Trans
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \In2code\Translation\Domain\Model\Trans();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCustomerReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCustomer()
        );
    }

    /**
     * @test
     */
    public function setCustomerForStringSetsCustomer()
    {
        $this->subject->setCustomer('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'customer',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFromLanguageReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFromLanguage()
        );
    }

    /**
     * @test
     */
    public function setFromLanguageForStringSetsFromLanguage()
    {
        $this->subject->setFromLanguage('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'fromLanguage',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getToLanguageReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getToLanguage()
        );
    }

    /**
     * @test
     */
    public function setToLanguageForStringSetsToLanguage()
    {
        $this->subject->setToLanguage('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'toLanguage',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSubjectFromReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSubjectFrom()
        );
    }

    /**
     * @test
     */
    public function setSubjectFromForStringSetsSubjectFrom()
    {
        $this->subject->setSubjectFrom('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'subjectFrom',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSubjectToReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSubjectTo()
        );
    }

    /**
     * @test
     */
    public function setSubjectToForStringSetsSubjectTo()
    {
        $this->subject->setSubjectTo('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'subjectTo',
            $this->subject
        );
    }
}
