<?php
namespace In2code\Translation\Controller;

use In2code\Translation\Domain\Repository\NewsRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class NewsController
 */
class NewsController extends ActionController
{

    /**
     * @return void
     */
    public function listAction()
    {
        $newsRepository = $this->objectManager->get(NewsRepository::class);
        $this->view->assign('news', $newsRepository->findAll());
    }

    /**
     * @return void
     */
    public function rssAction()
    {
        $newsRepository = $this->objectManager->get(NewsRepository::class);
        $this->view->assign('news', $newsRepository->findAll());
    }
}
