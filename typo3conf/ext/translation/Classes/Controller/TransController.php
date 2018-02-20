<?php
namespace In2code\Translation\Controller;

use In2code\Translation\Domain\Model\Trans;
use In2code\Translation\Domain\Repository\TransRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
     * @param array $filter
     * @return void
     */
    public function listAction(array $filter = [])
    {
        $translations = $this->transRepository->findByFilter($filter);
        $this->view->assign('translations', $translations);
        $this->view->assign('filter', $filter);
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
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * @param Trans $translation
     * @return void
     */
    public function createAction(Trans $translation)
    {
        $this->transRepository->add($translation);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashmessage.create', 'Translation')
        );
        $this->redirect('list');

        // Could be persisted at once if UID is needed here
        //$persistanceManager = $this->objectManager->get(PersistenceManager::class);
        //$persistanceManager->persistAll();
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
