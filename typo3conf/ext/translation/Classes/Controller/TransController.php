<?php
namespace In2code\Translation\Controller;

use In2code\Translation\Domain\Model\Trans;
use In2code\Translation\Domain\Repository\TransRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class TransController
 */
class TransController extends ActionController
{
    /**
     * @var TransRepository
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

    /**
     * @param Trans $translation => comes from &tx_translation_pi1[translation]=123
     * @return void
     */
    public function detailAction(Trans $translation)
    {
        $this->view->assign('translation', $translation);
    }

    /**
     * @param TransRepository $transRepository
     * @return void
     */
    public function injectTransRepository(TransRepository $transRepository)
    {
        $this->transRepository = $transRepository;
    }
}
