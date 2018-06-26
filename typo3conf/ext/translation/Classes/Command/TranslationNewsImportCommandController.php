<?php
declare(strict_types=1);
namespace In2code\Translation\Command;

use In2code\Translation\Domain\Model\News;
use In2code\Translation\Domain\Repository\NewsRepository;
use In2code\Translation\Domain\Repository\RssRepository;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class TranslationNewsImportCommandController
 */
class TranslationNewsImportCommandController extends CommandController
{

    /**
     * @var NewsRepository
     */
    protected $newsRepository = null;

    /**
     * CommandController for RSS import
     *
     * @param int $pageId Page id to import in
     * @param string $url URL to import RSS from
     * @return void
     */
    public function importCommand(int $pageId = 26, string $url = 'https://www.evs-translations.com/blog/feed/')
    {
        $rssRepository = $this->objectManager->get(RssRepository::class);
        $items = $rssRepository->getRssProperties($url);

        $this->updateOrImport($items, $pageId);

        $message = 'Successfully imported!';
        $this->addMessage($message, 'Success');
        $this->outputLine($message);
    }

    /**
     * @param array $items
     * @param int $pageId
     * @return void
     */
    protected function updateOrImport(array $items, int $pageId)
    {
        foreach ($items as $item) {
            if ($this->newsRepository->isExistingByLinkAndPageId($item['link'], $pageId)) {
                $this->update($item, $pageId);
            } else {
                $this->import($item, $pageId);
            }
        }
        $persistanceManager = $this->objectManager->get(PersistenceManager::class);
        $persistanceManager->persistAll();
    }

    /**
     * @param array $item
     * @param int $pageId
     * @return void
     */
    protected function update(array $item, int $pageId)
    {
        $news = $this->newsRepository->getByLinkAndPageId($item['link'], $pageId)->getFirst();
        $news->_setProperty('pid', $pageId);
        $news->setTitle($item['title']);
        $news->setDate($item['date']);
        $news->setDescription($item['description']);
        $news->setLink($item['link']);
        $this->newsRepository->update($news);
    }

    /**
     * @param array $item
     * @param int $pageId
     * @return void
     */
    protected function import(array $item, int $pageId)
    {
        /** @var News $news */
        $news = $this->objectManager->get(News::class);
        $news->_setProperty('pid', $pageId);
        $news->setTitle($item['title']);
        $news->setDate($item['date']);
        $news->setDescription($item['description']);
        $news->setLink($item['link']);
        $this->newsRepository->add($news);
    }

    /**
     * @param $message
     * @param string $title
     * @param int $severity
     * @return void
     */
    protected function addMessage($message, $title = '', $severity = FlashMessage::OK)
    {
        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            $message,
            $title,
            $severity
        );
        $flashMessageService = $this->objectManager->get(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $messageQueue->enqueue($message);
    }

    /**
     * @param NewsRepository $newsRepository
     * @return void
     */
    public function injectNewsRepository(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
}
