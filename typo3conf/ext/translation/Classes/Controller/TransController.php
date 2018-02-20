<?php
namespace In2code\Translation\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class TransController
 */
class TransController extends ActionController
{
    /**
     * @var \In2code\Translation\Domain\Repository\TransRepository
     * @inject
     */
    protected $transRepository = null;

    /**
     * @return void
     */
    public function listAction()
    {
        $translations = $this->transRepository->findAll();
        $this->view->assign('translations', $translations);
    }
}
