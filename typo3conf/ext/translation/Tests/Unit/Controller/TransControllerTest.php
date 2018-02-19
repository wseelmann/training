<?php
namespace In2code\Translation\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Alex Kellne <alexander.kellner@in2code.de>
 */
class TransControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \In2code\Translation\Controller\TransController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\In2code\Translation\Controller\TransController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllTranssFromRepositoryAndAssignsThemToView()
    {

        $allTranss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transRepository = $this->getMockBuilder(\In2code\Translation\Domain\Repository\TransRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $transRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTranss));
        $this->inject($this->subject, 'transRepository', $transRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('transs', $allTranss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
