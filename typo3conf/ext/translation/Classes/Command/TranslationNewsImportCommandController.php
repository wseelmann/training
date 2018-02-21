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
     * CommandController for RSS import
     *
     * @param int $pageId Page id to import in
     * @param string $url URL to import RSS from
     * @return void
     */
    public function importCommand(int $pageId = 26, string $url = 'https://www.evs-translations.com/blog/feed/')
    {
        $newsRepository = $this->objectManager->get(NewsRepository::class);
        $rssRepository = $this->objectManager->get(RssRepository::class);
        $persistanceManager = $this->objectManager->get(PersistenceManager::class);

        $items = $rssRepository->getRssProperties($url);
        foreach ($items as $item) {
            /** @var News $news */
            $news = $this->objectManager->get(News::class);
            $news->_setProperty('pid', $pageId);
            $news->setTitle($item['title']);
            $news->setDate($item['date']);
            $news->setDescription($item['description']);
            $news->setLink($item['link']);
            $newsRepository->add($news);
        }
        $persistanceManager->persistAll();

        $message = 'Successfully imported!';
        $this->addMessage($message, 'Success');
        $this->outputLine($message);
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
}
